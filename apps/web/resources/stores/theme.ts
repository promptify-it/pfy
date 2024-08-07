import { reactive } from 'vue';

export const themeStore = reactive<{
  theme: 'light' | 'dark';
}>({
  theme: 'light',
});
