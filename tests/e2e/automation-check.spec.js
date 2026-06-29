const { test, expect } = require('@playwright/test');
const fs = require('fs');
const path = require('path');

const checkFile = path.join(__dirname, '../../AUTOMATION_CHECK.md');

test('AUTOMATION_CHECK.md exists and documents issue #1', async () => {
  expect(fs.existsSync(checkFile)).toBeTruthy();

  const content = fs.readFileSync(checkFile, 'utf8');
  expect(content).toMatch(/server Cursor Agent/i);
  expect(content).toMatch(/Issue #1/);
});
