<?php

namespace App\Http\Controllers;

use File;
use Toastr;
use Exception;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row',10);
        if($row<1 || $row>100){
            abort(400,'The per-page parameter must be integer between 1 to 100.');

        }

        $products = Product::with(['category'])
                    ->filter(request(['search']))
                    ->paginate($row)
                    ->appends(request()->query());

            return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        return view('products.create',compact('categories'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product;
            $product->product_name=$request->proName;
            $product->category_id=$request->categoryId ;
            $product->selling_price=$request-> sellingPrice;
            $product->product_code=$request->productCode ;
            $product->brand=$request->brand;
    
            if($request->hasFile('product_image')){
                $imageName=rand(111,999).time().'.'.$request->product_image->extension();
                $request->product_image->move(public_path('uploads/productImage'),$imageName);
                $product->product_image=$imageName;
            }
            $product->created_by=currentUserId();
            if( $product->save())
            $this->notice::success('Product has been added');
            return redirect()->route('products.index');
        } catch (Exception $e) {
            // dd($e);
        }
    

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //general barcode

        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product->product_code,$generator::TYPE_CODE_128);
         return view('products.show', [
        'product' => $product,
        'barcode' => $barcode,
    ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id )
    {
        $product = Product::findorFail($id);
        return view('products.edit',[
            'categories' => Category::all(),
            'product' => $product
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {

        try {
            $product = Product::findorFail($id);
            $product->update($request->except('product_image'));
            $product->product_name=$request->proName;
            $product->category_id=$request->categoryId ;
            $product->selling_price=$request-> sellingPrice;
            $product->product_code=$request->productCode ;
            $product->brand=$request->brand;
            //handel upload image
            if($request->hasFile('product_image')){
                //Delete Old Photo
                // if($product->product_image){
                //     unlink(public_path('uploads/productImage'));
                // }
    
                //prepare New Photo
                $imageName=rand(111,999).time().'.'.$request->product_image->extension();
                $request->product_image->move(public_path('uploads/productImage'),$imageName);
                $product->product_image=$imageName;
    
                //save DB
                $product->update([
                    'product_image' => $imageName
                ]);
                $product->updated_by=currentUserId();
                $product->save();
                $this->notice::success('Data successfully updated');
                return redirect()->route('products.index');
                               
            }
        } catch (Exeption $e) {
            dd($e);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    // {
    //     if($product->product_image){
    //         unlink(public_path('uploads/productImage/') . $product->image);
    //     }
    //     $product->delete();
    //     return redirect()->route('product.index')->with('success','Product has beed Deleted');
    // }
{

    try {
        $product= Product::findOrFail(encryptor('decrypt',$id));
    $image_path=public_path('uploads/producsImage/'.$product->product_image);

    if($product->delete()){
        if(File::exists($image_path))
            File::delete($image_path);

            $this->notice::success('Data successfully deleted');
        return redirect()->back();
    }
    } catch (Exception $e) {
        dd($e);
    }
}

 /**
     * Handle export data products.
     */
    public function import()
    {
        return view('products.import');
    }

    public function handleImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'J', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'product_name' => $sheet->getCell( 'A' . $row )->getValue(),
                    'category_id' => $sheet->getCell( 'B' . $row )->getValue(),
                    'product_code' => $sheet->getCell( 'C' . $row )->getValue(),
                    'selling_price' =>$sheet->getCell( 'D' . $row )->getValue(),
                    'product_image' =>$sheet->getCell( 'E' . $row )->getValue(),
                    'brand' =>$sheet->getCell( 'F' . $row )->getValue(),
                ];
                $startcount++;
            }

            Product::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return redirect()
                ->route('products.index')
                ->with('error', 'There was a problem uploading the data!');
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Data product has been imported!');
    }

    /**
     * Handle export data products.
     */
    function export(){
        $products = Product::all()->sortBy('product_name');

        $product_array [] = array(
            'Product Name',
            'Category Id',
            'Product Code',
            'Selling Price',
            'Product Image',
            'Brand',
        );

        foreach($products as $product)
        {
            $product_array[] = array(
                'Product Name' => $product->product_name,
                'Category Id' => $product->category_id,
                'Product Code' => $product->product_code,
                'Selling Price' =>$product->selling_price,
                'Product Image' => $product->product_image,
                'Brand' => $product->brand,
            );
        }

        $this->exportExcel($product_array);
    }

    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function exportExcel($products){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($products);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="products.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }


}


