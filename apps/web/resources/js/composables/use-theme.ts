import { computed } from 'vue';
import { themeStore } from '../../stores/theme';

export function useTheme() {
  const init = () => {
    if (localStorage.theme == 'light') {
      setTheme('light');
      return;
    }

    if (
      localStorage.theme === 'dark' ||
      window.matchMedia('(prefers-color-scheme: dark)').matches ||
      document.documentElement.classList.contains('dark')
    ) {
      setTheme('dark');
    }
  };

  const setTheme = (type: 'light' | 'dark') => {
    themeStore.theme = type;
    document.documentElement.classList.toggle('dark', type === 'dark');
    localStorage.theme = type;
  };

  const toggleTheme = () => {
    themeStore.theme = themeStore.theme === 'light' ? 'dark' : 'light';

    document.documentElement.classList.toggle('dark');

    localStorage.theme = document.documentElement.classList.contains('dark')
      ? 'dark'
      : 'light';
  };

  return {
    theme: computed(() => themeStore.theme),
    init,
    toggleTheme,
  };
}
