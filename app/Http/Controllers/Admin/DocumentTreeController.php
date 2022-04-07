<?php

namespace App\Http\Controllers\Admin;

use App\DocumentTree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DocumentTreeController extends Controller
{
    public function manageDocuments()
    {
        Session::put('page', 'document-tree');
        $categories = DocumentTree::where('parent_id', '=', 0)->get(['id', 'name', 'url_file']);
        $allCategories = DocumentTree::pluck('name', 'id')->all();
        $companyData = getCompanyData();
        return view('admin.documentTree.document_tree', compact('categories', 'allCategories', 'companyData'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addTree(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $documentTree = new DocumentTree();
            $documentTree->name = $input['name'] ?? '';
            $documentTree->parent_id = empty($input['parent_id']) ? 0 : $input['parent_id'];
            $documentTree->save($input);
            Session::flash('success_message', 'El arbol se creo correctamente');
            return redirect()->route('dashboard.document-tree.index');
        }
        $categories = DocumentTree::where('parent_id', '=', 0)->get();
        $allCategories = DocumentTree::pluck('name', 'id')->all();
        $companyData = getCompanyData();
        return view('admin.documentTree.add_document_tree',  compact('categories', 'allCategories', 'companyData'));
    }

    public function editTree(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $documentTree = new DocumentTree();
            if ($request->hasFile('fileDocument')) {
                $documentTree->url_file = $this->loadFile($request, 'fileDocument', 'tree/files', 'tree');
            }
            $documentTree->name = $input['name'];
            $documentTree->parent_id = empty($input['parent_id']) ? 0 : $input['parent_id'];
            $documentTree->save($input);
            return redirect()->back();
        }
        $parentId = $id;
        $treeDetail = DocumentTree::where('parent_id', '=', $id)->get();
        $allChilds = DocumentTree::where('parent_id', '=', $id)->pluck('name', 'id')->all();
        $companyData = getCompanyData();
        return view('admin.documentTree.edit_document_tree',  compact('parentId', 'treeDetail', 'allChilds', 'companyData'));
    }

    public function getDataNode($id)
    {
        $documentTree = DocumentTree::find($id);
        return $documentTree;
    }

    public function storeToTree(Request $request)
    {
        $url = $this->loadFile($request, 'file', 'tree/files', 'tree');
        return response()->json([
            'message' => 'archivo subido exitosamente',
            'url' => $url,
        ]);
    }

    public function editHeader(Request $request, $id = null)
    {
        $data = $request->all();
        $documentTree = DocumentTree::find($id);
        $documentTree->name = $data['nameHeader'] ?? '';
        $documentTree->update();
        return redirect()->back();
    }

    public function editNode(Request $request, $id = null)
    {
        $data = $request->all();
        $documentTree = DocumentTree::find($id);
        $documentTree->name = $data['nameNode'] ?? '';
        if ($request->hasFile('fileNode')) {
            $documentTree->url_file = $this->loadFile($request, 'fileNode', 'tree/files', 'tree');
        } else {
            $documentTree->url_file = $data['currentFile'] ?? '';
        }
        $documentTree->update();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $documentTreeFind = DocumentTree::find($id);
        if ($documentTreeFind->parent_id != 0) {
            $documentTreeFind->delete();
            return redirect()->back();
        } else {
            $documentTreeFind->delete();
            $message = 'El arbol se elimino correctamente';
            Session::flash('success_message', $message);
            return redirect()->route('dashboard.document-tree.index');
        }
    }
}
