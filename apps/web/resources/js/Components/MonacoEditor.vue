<script setup lang="ts">
import { useTheme } from '@/composables/use-theme';
import * as monaco from 'monaco-editor';
import { onMounted, ref, watch } from 'vue';
import '../worker';

const props = withDefaults(
  defineProps<{
    defaultValue?: string;
    modelValue: string;
  }>(),
  {
    modelValue: '',
  },
);

const emit = defineEmits<{
  (event: 'update:modelValue', value: string): void;
}>();
const { theme, init } = useTheme();

const editor = ref();

onMounted(async () => {
  init();

  const monacoEditor = monaco.editor.create(editor.value, {
    value: props.modelValue,
    language: 'json',
    theme: theme.value == 'light' ? 'vs' : 'vs-dark',
    minimap: {
      enabled: false,
    },
  });

  watch(
    () => theme.value,
    () => {
      monaco.editor.setTheme(theme.value == 'light' ? 'vs' : 'vs-dark');
    },
  );

  monacoEditor.onDidChangeModelContent(() => {
    const value = monacoEditor.getValue();

    emit('update:modelValue', value);
  });

  monaco.languages.json.jsonDefaults.setDiagnosticsOptions({
    validate: true,
    schemas: [
      {
        uri: 'http://json-schema.org/draft-07/schema#',
        fileMatch: ['*'],
        schema: {
          $schema: 'http://json-schema.org/draft-07/schema#',
          type: 'object',
          properties: {
            signature: {
              type: 'string',
            },
            description: {
              type: 'string',
            },
            root: {
              type: 'object',
              properties: {
                nodes: {
                  type: 'array',
                  items: {
                    type: 'object',
                    properties: {
                      type: {
                        enum: [
                          'assign',
                          'condition',
                          'file-template',
                          'password-input',
                          'select-input',
                          'shell',
                          'text-input',
                        ],
                      },
                      content: {
                        type: 'object',
                        properties: {},
                      },
                    },
                    allOf: [
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'assign',
                            },
                          },
                        },
                        then: {
                          properties: {
                            type: {
                              description: 'Assign a value to a key',
                            },
                            content: {
                              type: 'object',
                              properties: {
                                key: {
                                  type: 'string',
                                  description: 'The key to assign the value to',
                                },
                                value: {
                                  type: 'string',
                                  description: 'The value to assign to the key',
                                },
                              },
                              required: ['key', 'value'],
                            },
                          },
                        },
                      },
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'condition',
                            },
                          },
                        },
                        then: {
                          properties: {
                            content: {
                              type: 'object',
                              properties: {
                                left: {
                                  type: 'string',
                                  description: 'The left side of the condition',
                                },
                                operator: {
                                  enum: ['==', '!=', '>', '<', '>=', '<='],
                                  description:
                                    'The operator to use in the condition',
                                },
                                right: {
                                  type: 'string',
                                  description:
                                    'The right side of the condition',
                                },
                              },
                              required: ['left', 'operator', 'right'],
                            },
                          },
                        },
                      },
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'file-template',
                            },
                          },
                        },
                        then: {
                          content: {
                            type: 'object',
                            properties: {
                              template: {
                                type: 'array',
                                description: 'File lines of the template',
                                items: {
                                  type: 'string',
                                  description: 'A line of the file template',
                                },
                              },
                              output: {
                                type: 'string',
                                description: 'The output file path',
                              },
                            },
                            required: ['template', 'output'],
                          },
                        },
                      },
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'password-input',
                            },
                          },
                        },
                        then: {
                          properties: {
                            content: {
                              type: 'object',
                              properties: {
                                label: {
                                  type: 'string',
                                  description:
                                    'The label of the password input',
                                },
                                key: {
                                  type: 'string',
                                  description: 'The key to assign the value to',
                                },
                              },
                              required: ['label', 'key'],
                            },
                          },
                        },
                      },
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'select-input',
                            },
                          },
                        },
                        then: {
                          properties: {
                            content: {
                              type: 'object',
                              properties: {
                                label: {
                                  type: 'string',
                                  description: 'The label of the select input',
                                },
                                key: {
                                  type: 'string',
                                  description: 'The key to assign the value to',
                                },
                                options: {
                                  type: 'array',
                                  description:
                                    'The options of the select input',
                                  items: {
                                    type: 'string',
                                    description:
                                      'An option of the select input',
                                  },
                                },
                              },
                              required: ['label', 'key', 'options'],
                            },
                          },
                        },
                      },
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'shell',
                            },
                          },
                        },
                        then: {
                          properties: {
                            content: {
                              type: 'object',
                              properties: {
                                script: {
                                  type: 'string',
                                  description: 'The shell script to run',
                                },
                              },
                              required: ['script'],
                            },
                          },
                        },
                      },
                      {
                        if: {
                          properties: {
                            type: {
                              const: 'text-input',
                            },
                          },
                        },
                        then: {
                          properties: {
                            content: {
                              type: 'object',
                              properties: {
                                label: {
                                  type: 'string',
                                  description: 'The label of the text input',
                                },
                                key: {
                                  type: 'string',
                                  description: 'The key to assign the value to',
                                },
                              },
                              required: ['label', 'key'],
                            },
                          },
                        },
                      },
                    ],
                    required: ['type', 'content'],
                  },
                },
              },
              required: ['nodes'],
            },
          },
          required: ['signature', 'description', 'root'],
        },
      },
    ],
  });
});
</script>

<template>
  <div id="editor" ref="editor"></div>
</template>

<style>
.monaco-editor .margin,
.sticky-widget,
.monaco-editor-background {
  @apply dark:!bg-neutral-900;
  /* --vscode-editor-background: rgb(17 24 39 / var(--tw-bg-opacity)) !important; */
}

#root {
  @apply !border dark:border-neutral-800;
}
</style>
