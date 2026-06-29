const { test, expect } = require('@playwright/test');
const fs = require('fs');
const path = require('path');

const themeDir = path.join(__dirname, '../../wp-content/themes/lzzen-relay');

const requiredThemeFiles = [
  'style.css',
  'functions.php',
  'front-page.php',
  'page-relays.php',
  'single-relay.php',
  'header.php',
  'footer.php',
  'inc/data.php',
  'inc/helpers.php',
  'assets/theme.css',
  'assets/theme.js',
  'template-parts/relay-card.php'
];

test.describe('lzzen-relay theme files', () => {
  for (const file of requiredThemeFiles) {
    test(`${file} exists`, () => {
      expect(fs.existsSync(path.join(themeDir, file))).toBeTruthy();
    });
  }

  test('style.css declares the lzzen-relay theme', () => {
    const style = fs.readFileSync(path.join(themeDir, 'style.css'), 'utf8');
    expect(style).toMatch(/Theme Name:\s*Lzzen Relay/i);
    expect(style).toMatch(/Text Domain:\s*lzzen-relay/i);
  });

  test('sample data includes vip.j3gb.com', () => {
    const data = fs.readFileSync(path.join(themeDir, 'inc/data.php'), 'utf8');
    expect(data).toMatch(/vip\.j3gb\.com/);
    expect(data).toMatch(/vip-j3gb-com/);
  });
});

async function isRelayThemeActive(page) {
  await page.goto('/');
  return page.locator('body.lzzen-relay').count();
}

test.describe('lzzen-relay pages', () => {
  test('relay listing page renders cards when theme is active', async ({ page }) => {
    if ((await isRelayThemeActive(page)) === 0) {
      test.skip(true, 'lzzen-relay theme is not active on the test site');
    }

    const response = await page.goto('/relays/');
    expect(response).not.toBeNull();
    expect(response.status()).toBeLessThan(400);

    await expect(page.locator('[data-testid="relay-list-page"]')).toBeVisible();
    await expect(page.locator('[data-testid="relay-all-section"]')).toBeVisible();
    await expect(page.locator('[data-testid="relay-card"]').first()).toBeVisible();
    await expect(page.getByRole('heading', { name: /AI API 中转站导航/i })).toBeVisible();
  });

  test('relay detail page shows score panel and history', async ({ page }) => {
    if ((await isRelayThemeActive(page)) === 0) {
      test.skip(true, 'lzzen-relay theme is not active on the test site');
    }

    const response = await page.goto('/leaderboard/vip-j3gb-com/');
    expect(response).not.toBeNull();
    expect(response.status()).toBeLessThan(400);

    await expect(page.locator('[data-testid="relay-detail-page"]')).toBeVisible();
    await expect(page.locator('[data-testid="relay-score-panel"]')).toBeVisible();
    await expect(page.locator('[data-testid="relay-history-section"]')).toBeVisible();
    await expect(page.getByRole('heading', { name: /vip\.j3gb\.com 中转站测评/i })).toBeVisible();
    await expect(page.getByText('82')).toBeVisible();
  });

  test('listing links to relay detail page', async ({ page }) => {
    if ((await isRelayThemeActive(page)) === 0) {
      test.skip(true, 'lzzen-relay theme is not active on the test site');
    }

    await page.goto('/relays/');
    await page.locator('[data-relay-slug="vip-j3gb-com"] a').first().click();
    await expect(page).toHaveURL(/\/leaderboard\/vip-j3gb-com\/?$/);
    await expect(page.locator('[data-testid="relay-detail-page"]')).toBeVisible();
  });
});
