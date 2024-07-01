<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Expense;
use App\Models\ExpenseType;

use Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $property = Property::where(['added_by_id' => Auth::user()->id , 'active_property'=>true])
            ->get();
        $expense_types = ExpenseType::where(['status' => true])
            ->get();    
        //dd($property->toARray());
        return view('landlord.expenses.create',compact('property','expense_types'));
    }

    public function store(request $request){
        //dd($request->toArray());
        $request->validate([
            'expense' => 'required',
            'property' => 'required',
            'date'=> 'required',
            'amount' => 'required|regex:/^\$[0-9]{1,3}(,[0-9]{3})*(\.[0-9]{2})?$/'
        ]);

        $amount = str_replace(array('$', ','), '', $request->amount);

        if(!$amount){
            return redirect()->back()->with('amountError','Please enter valid amount');
        }
        

        $date1 = new \DateTime($request->date);
        $start = $date1->format('Y-m-d');
        $start_temp = $date1->format('m/d/Y');

        $expense = new Expense;
        $expense->added_by_id = Auth::user()->id;
        $expense->expense_type = $request->expense;
        $expense->property = $request->property;
        $expense->desc = $request->desc;
        $expense->company_name = $request->company_name;
        $expense->amount = str_replace(array('$', ','), '', $request->amount);
        $expense->date = $start;
        $expense->show_date = $start_temp;

        $expense->note = $request->note;
        $year = explode('/', $request->date);
        $expense->year = $year[2];

        if($files = $request->file('receipt')) {
            $fileName = $request->file('receipt')->getClientOriginalName();
            $request->receipt->move(public_path('landlord/expenses'), $fileName);
    
            if($fileName){
                $expense->receipt = $fileName;
            }
        }

       

        $expense->save();
        return redirect()->route('landlord.list.expenses')->with('message', 'Expense Saved Successfully.');
    }

    public function list(){
        $expenses = Expense::where(['added_by_id' => Auth::user()->id])->get();
        // dd($expenses->toArray());
        $property = Property::where(['added_by_id' => Auth::user()->id])->get();
        return view('landlord.expenses.list');
    }

    public function expenseLists(request $request){
        
        if($request->ajax()){
        $query = Expense::query();
        $data = $query->where(['expenses.added_by_id'=> Auth::user()->id,'year'=>$request->year])
                ->join('properties as p', 'p.id', '=', 'expenses.property')
                ->get(['expenses.id','expenses.expense_type','expenses.amount','expenses.show_date','p.property_name','expenses.receipt']);
        
                return response()->json(['data'=>$data]);
        }
    }

    public function destroy($id){
        Expense::where('id',$id)->delete();

        return redirect()->route('landlord.list.expenses')->with('message', 'Expense Deleted successfully.');
    }

    public function viewExpense($id){
        $expense = Expense::where(['id' => $id, 'added_by_id' => Auth::user()->id])->first();
        $property = Property::where(['added_by_id' => Auth::user()->id])->get();
        //dd($expense->toArray());
        return view('landlord.expenses.view-expense', compact('expense','property'));
    }
    public function editExpense($id){
        $expense = Expense::where(['id' => $id, 'added_by_id' => Auth::user()->id])->first();
        $property = Property::where(['added_by_id' => Auth::user()->id])->get();
        $expense_types = ExpenseType::where(['status' => true])
            ->get();  
        //dd($expense->toArray());
        return view('landlord.expenses.edit-expense', compact('expense','property','expense_types'));
    }

    public function updateExpense(request $request){
        $request->validate([
            'expense' => 'required',
            'property' => 'required',
            'date'=> 'required',
            'amount' => 'required|regex:/^\$[0-9]{1,3}(,[0-9]{3})*(\.[0-9]{2})?$/'
        ]);
        $date1 = new \DateTime($request->date);
        $start = $date1->format('Y-m-d');
        $start_temp = $date1->format('m/d/Y');

        $expense = Expense::where(['id' => $request->id])->first();
        $expense->added_by_id = Auth::user()->id;
        $expense->expense_type = $request->expense;
        $expense->property = $request->property;
        $expense->desc = $request->desc;
        $expense->company_name = $request->company_name;
        $expense->amount = str_replace(array('$', ','), '', $request->amount);
        $expense->date = $start;
        $expense->show_date = $start_temp;
        $expense->note = $request->note;
        $year = explode('/', $request->date);
        $expense->year = $year[2];

        if($files = $request->file('receipt')) {
            $fileName = $request->file('receipt')->getClientOriginalName();
            $request->receipt->move(public_path('landlord/expenses'), $fileName);
    
            if($fileName){
                $expense->receipt = $fileName;
            }
        }
        $expense->save();
        return redirect()->route('landlord.list.expenses')->with('message', 'Expense Saved Successfully.');
    }
}
