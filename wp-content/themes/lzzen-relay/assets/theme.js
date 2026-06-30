document.addEventListener('click', (event) => {
  const button = event.target.closest('[data-toggle-target]');
  if (!button) {
    return;
  }

  const targetId = button.getAttribute('data-toggle-target');
  const target = document.getElementById(targetId);
  if (!target) {
    return;
  }

  const collapsed = target.classList.toggle('is-collapsed');
  button.textContent = collapsed
    ? button.textContent.replace('收起', '展开')
    : button.textContent.replace('展开', '收起');
});
