<?php

namespace Pfy\Core\Data\Nodes\Shell;

use Pfy\Core\Contracts\DataPiper;
use Pfy\Core\Contracts\Executable;
use Pfy\Core\Data\Nodes\NodeData;

/**
 * @property ShellNodeContentData $content
 */
class ShellNodeData extends NodeData implements Executable
{
    public function execute(DataPiper $dataPiper): void
    {
        $descriptorSpec = [
            0 => ['pipe', 'r'],  // Standard input
            1 => ['pipe', 'w'],  // Standard output
            2 => ['pipe', 'w'],  // Standard error
        ];

        $script = $this->content->script;

        if (! str_ends_with($script, ';')) {
            $script .= ';';
        }

        $script .= 'env > '.$dataPiper->path();

        $proc = proc_open($script, $descriptorSpec, $pipes, null, $dataPiper->all());

        if (is_resource($proc)) {
            // Set the pipes to non-blocking mode
            stream_set_blocking($pipes[1], false);
            stream_set_blocking($pipes[2], false);

            // Close standard input as it's not needed
            fclose($pipes[0]);

            while (true) {
                $stdout = stream_get_contents($pipes[1]);
                $stderr = stream_get_contents($pipes[2]);

                if ($stdout !== false && $stdout !== '') {
                    echo $stdout;
                }

                if ($stderr !== false && $stderr !== '') {
                    echo $stderr;
                }

                // Check if the process has terminated
                $status = proc_get_status($proc);
                if (! $status['running']) {
                    break;
                }

                // Small sleep to prevent busy waiting
                usleep(100000); // 0.1 seconds
            }

            // Close the remaining pipes
            fclose($pipes[1]);
            fclose($pipes[2]);

            // Close the process
            proc_close($proc);
        }

        $dataPiper->mergeFromPipe();
    }
}
