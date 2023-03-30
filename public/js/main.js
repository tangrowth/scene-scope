const companyText = document.querySelector('.company-text');
const companyFullText = document.querySelector('.company-full-text');

companyText.addEventListener('mouseover', function() {
  companyText.style.display = 'none';
  companyFullText.style.display = 'block';
});

companyFullText.addEventListener('mouseout', function() {
  companyFullText.style.display = 'none';
  companyText.style.display = 'block';
});
