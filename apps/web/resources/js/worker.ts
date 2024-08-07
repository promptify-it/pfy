import editorWorker from 'monaco-editor/esm/vs/editor/editor.worker?worker';
import jsonWorker from 'monaco-editor/esm/vs/language/json/json.worker?worker';

self.MonacoEnvironment = {
  getWorker(_, label: string) {
    if (label === 'json') {
      return new jsonWorker();
    }

    return new editorWorker();
  },
};
