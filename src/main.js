import './main.scss';

// Function to reload the quote drawer content.
function reloadQuoteDrawer() {
	fetch(window.location.href)
		.then(res => res.text())
		.then(html => {
			const doc = new DOMParser().parseFromString(html, 'text/html');
			const newContent = doc.querySelector('#quote-drawer > *');
			const drawer = document.querySelector('#quote-drawer');

			if (newContent && drawer) {
				drawer.innerHTML = newContent.parentElement.innerHTML;
				drawer.classList.add('is-open');
				document.body.style.overflow = 'hidden';
			}
		});
}

// Wait for AJAX to finish.
jQuery(document).ajaxComplete(function (event, xhr, settings) {
	if (!settings?.data) return;

	if (
		settings.data.includes('add_to_quote') ||
		settings.data.includes('remove_quote_item') ||
		settings.data.includes('update_quote')
	) {
		reloadQuoteDrawer();
	}
});

// Close drawer
document.addEventListener('click', function (e) {
	const closeTrigger = e.target.closest('.qd-overlay, .qd-close');
	if (!closeTrigger) return;

	const drawer = document.getElementById('quote-drawer');
	if (!drawer) return;

	drawer.classList.remove('is-open');
	document.body.style.overflow = '';
});

document.addEventListener('click', function (e) {
	const openMiniQuote = e.target.closest('.view-mini-quote-btn a');
	if (!openMiniQuote) return;

	const drawer = document.getElementById('quote-drawer');
	if (!drawer) return;

	drawer.classList.add('is-open');
	document.body.style.overflow = 'hidden';
});
