const { test, expect } = require('@playwright/test');

test('home page is available', async ({ page }) => {
  const response = await page.goto('/');

  expect(response).not.toBeNull();
  expect(response.status()).toBeLessThan(400);
  await expect(page.locator('body')).toBeVisible();
  await expect(page).toHaveTitle(/.+/);
});

test('login page renders a usable form', async ({ page }) => {
  const response = await page.goto('/wp-login.php');

  expect(response).not.toBeNull();
  expect(response.status()).toBeLessThan(400);
  await expect(page.locator('#user_login')).toBeVisible();
  await expect(page.locator('#user_pass')).toBeVisible();
  await expect(page.locator('#wp-submit')).toBeVisible();
});

test('WordPress REST API responds', async ({ page }) => {
  const response = await page.goto('/wp-json/wp/v2/posts?per_page=1&_fields=id');

  expect(response).not.toBeNull();
  expect(response.ok()).toBeTruthy();
  const payload = JSON.parse(await page.locator('body').innerText());
  expect(Array.isArray(payload)).toBeTruthy();
});


