<?php

namespace App\Http\Controllers\Account;

use App\File;
use App\Http\Requests\File\StoreFileRequest;
use App\Http\Requests\File\UpdateFileRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    
    public function create(File $file)
    {
        if ( ! $file->exists) {
            $file = $this->createAndReturnSkeletonFile();
            
            return redirect()->route('account.files.create', $file);
        }
        $this->authorize('touch', $file);
        
        return view('account.files.create', compact('file'));
    }
    
    public function edit(File $file)
    {
        $this->authorize('touch', $file);
        $approval = $file->approvals()->first();
        
        return view('account.files.edit', compact('file', 'approval'));
    }
    
    public function update(UpdateFileRequest $request, File $file)
    {
        $this->authorize('touch', $file);
//        dd($request->get('live'));
        
        $ApprovalProperties = $request->only(File::APPROVAL_PROPERTIES);
        
        if ($file->needsApproval($ApprovalProperties)) {
            $file->createApproval($ApprovalProperties);
            
            return back()->with('success', 'We will review your changes soon.');
        }
        
        $file->update([
            'price' => $request->get('price'),
            'live'  => $request->has('live') ? true : false,
        ]);
        
        return back()->with('success', 'Updated !!');
    }
    
    public function store(StoreFileRequest $request, File $file)
    {
        $this->authorize('touch', $file);
        $file->fill($request->only(['title', 'overview_short', 'overview', 'price']));
        $file->finished = true;
        $file->save();
        
        
        return redirect()->route('account.files.index')
            ->with('success', 'Thanks, submitted for review');
    }
    
    public function index()
    {
        $files = auth()->user()->files()->latest()->finished()->get();
        
        return view('account.files.index', compact('files'));
    }
    
    private function createAndReturnSkeletonFile()
    {
        return auth()->user()->files()->create([
            'title'          => 'Untitled',
            'overview'       => 'None',
            'overview_short' => 'None',
            'price'          => 0,
            'finished'       => false,
        ]);
    }
}
