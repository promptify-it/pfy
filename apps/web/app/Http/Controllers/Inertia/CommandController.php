<?php

namespace Pfy\Web\Http\Controllers\Inertia;

use Pfy\Web\Http\Controllers\Controller;
use Pfy\Web\Models\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $commands = $user->currentTeam->commands;

        return Inertia::render('Commands/Index', [
            'commands' => $commands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Commands/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(
            $this->textareaContentToJson($request->input('definition')),
        );

        Validator::make($request->all(), [
            'definition' => 'string',
            'signature' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'root' => ['required', 'array'],
        ])->validateWithBag('createCommand');

        $command = Command::create([
            'signature' => $request->input('signature'),
            'description' => $request->input('description'),
            'root' => $request->input('root'),
        ]);

        $request->user()->currentTeam->commands()->attach($command);

        return redirect()->route('command.index');
    }

    /**
     * Convert textarea content to JSON.
     * Clean up the content and convert it to JSON.
     */
    private function textareaContentToJson(string $content)
    {
        return json_decode(str($content)->replace("\n", '')->squish()->toString(), true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Command $command)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Command $command)
    {
        return Inertia::render('Commands/Edit', [
            'command' => [
                'id' => $command->id,
                'definition' => json_encode([
                    'signature' => $command->signature,
                    'description' => $command->description,
                    'root' => $command->root,
                ], JSON_PRETTY_PRINT),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Command $command)
    {
        $request->merge(
            $this->textareaContentToJson($request->input('definition')),
        );

        Validator::make($request->all(), [
            'definition' => 'string',
            'signature' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'root' => ['required', 'array'],
        ])->validateWithBag('createCommand');

        $command = $command->update([
            'signature' => $request->input('signature'),
            'description' => $request->input('description'),
            'root' => $request->input('root'),
        ]);

        return redirect()->route('command.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Command $command)
    {
        $user = request()->user();
        $user->currentTeam->commands()->detach($command);

        if ($command->teams->count() === 0) {
            $command->delete();
        }

        return redirect()->to(route('command.index'));
    }

    public function clone(Command $command)
    {
        $clonedCommand = $command->replicate();
        $clonedCommand->signature = $command->signature . ':clone';
        $clonedCommand->save();

        $user = request()->user();
        $user->currentTeam->commands()->attach($clonedCommand);

        return redirect()->to(route('command.index'));
    }
}
