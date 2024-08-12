import { detect } from 'detect-browser';

export function isTouchDevices() {
  const browser = detect();

  return browser.os === 'Android OS' || browser.os === 'iOS';
}

export function isSafari() {
  const browser = detect();

  return browser.name === 'safari';
}

export const getIndexPage = () => {
  const pathNameMatch = window.location.pathname.match(/\d/);
  return pathNameMatch !== null ? Number(pathNameMatch[0]) : 1;
};

const vhDevices = () => {
  let vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', `${vh}px`);
};

export function utils() {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve();
      vhDevices();
      window.addEventListener('resize', () => {
        vhDevices();
      });
    }, 10);
  });
}
