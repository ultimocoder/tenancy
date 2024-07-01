<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Auth;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function document(){
        
        $tenant = Session::get('tenant_id');
        
        $docs = Document::where(['added_by_id' => Auth::user()->id, 'tenant_id' => $tenant])->get()->sortByDesc('id');
        return view('landlord.documents.document',compact('docs'));
    }

    public function store(request $request){
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx', // Validation rules for PDF and DOC/DOCX files
        ]);
        
        //$fileName = time().'.'.$request->file->extension(); 
        
        $fileName = $request->file('file')->getClientOriginalName();
        $request->file->move(public_path('landlord/upload-documents'), $fileName);

        $doc = new Document;
        $doc->desc = $request->desc;
        $doc->tenant_id = Session::get('tenant_id');
        $doc->size = $request->size;
        $doc->date = date('Y-m-d');
        $doc->document = $fileName;
        $doc->added_by_id = Auth::user()->id;

        if($request->share){
            $doc->share = true;  
        }else{
            $doc->share = false;
        }
        $doc->save();
        /*  
            Write Code Here for
            Store $fileName name in DATABASE from HERE 
        */
        
        return back()
            ->with('message','You have successfully upload file.')
            ->with('file', $fileName);
    
    }
    public function download($filname){
        //$doc = Document::where('id'.$id)->first();

        //$file = Storage::disk('local')->path("uploads/$fileName");

        $file = Storage::disk('local')->path("uploads/$fileName");

        if (file_exists($file)) {
            return response()->download($file);
        }
        return Storage::download($doc->document);
    }

    public function documentEditList(){
        $tenant = Session::get('tenant_id');
        $docs = Document::where(['added_by_id' => Auth::user()->id, 'tenant_id' => $tenant])->get()->sortByDesc('id');
        return view('landlord.documents.document-edit',compact('docs'));
    }

    public function documentDelete(request $request){
        $doc = Document::where(['id' => $request->doc_id, 'added_by_id' => Auth::user()->id])->first();
        if($doc->share){
            return redirect()->route('landlord.document.edit')->with('error', 'The document remains undeleted as it is in shared mode.');
        }
        else{
        // if($doc->document){
        //     unlink(public_path('landlord/upload-documents/'.$doc->document));
        // } 
        $doc->delete();
            //return redirect()->route('landlord.document.edit')->with('error', 'Document Deleted successfully.');
            return response()->json(['message' => 'Deleted Successfully']);
        }
        
    }

    public function changeStatus(Request $request)
    {
        $doc = Document::find($request->doc_id);
        if($request->status == 0){
            $doc->share = $request->status;
            
        }else{
            $doc->share = $request->status;
        }
        $doc->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $docs = Document::whereIn('id',explode(",",$ids))->get();
        // foreach($docs as $doc){
        //     if($doc->document){
        //         unlink(public_path('landlord/upload-documents/'.$doc->document));
        //     }  
        // }
        Document::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Document Deleted successfully."]);
    }
    
}
