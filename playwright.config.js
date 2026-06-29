const { defineConfig, devices } = require('@playwright/test');

const baseURL = process.env.TEST_BASE_URL;

if (!baseURL) {
  throw new Error('TEST_BASE_URL is required');
}

module.exports = defineConfig({
  testDir: './tests/e2e',
  timeout: 30_000,
  retries: 1,
  workers: 2,
  reporter: [
    ['list'],
    ['html', { open: 'never' }],
    ['junit', { outputFile: 'test-results/junit.xml' }]
  ],
  use: {
    baseURL,
    trace: 'retain-on-failure',
    screenshot: 'only-on-failure',
    video: 'retain-on-failure'
  },
  projects: [
    {
      name: 'chromium',
      use: { ...devices['Desktop Chrome'] }
    }
  ]
});
