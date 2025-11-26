<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('backend.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);
        Supplier::create($request->only(['name', 'email', 'phone', 'address']));
        return redirect()->route('supplier.index')->with('success', 'Thêm nhà cung cấp thành công!');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);
        $supplier->update($request->only(['name', 'email', 'phone', 'address']));
        return redirect()->route('supplier.index')->with('success', 'Cập nhật nhà cung cấp thành công!');
    }

    public function deleteConfirm($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.delete', compact('supplier'));
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Xóa nhà cung cấp thành công!');
    }
}
