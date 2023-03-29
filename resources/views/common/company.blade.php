<div class="company-card">
  <div class="company-card-img"><img src="{{ $company->img_url }}" alt="画像なし"></div>
  <div class="company-cars-content">
    <p>{{ $company->name }}</p>
    <p class="company-text">{{ Str::limit($performance->company->discription, 20) }}</p>
    <script>
      const companyText = document.querySelector('.company-text');
      const companyFullText = document.querySelector('.company-full-text');

      companyText.addEventListener('mouseover', function() {
        companyFullText.style.display = 'block';
      });

      companyText.addEventListener('mouseout', function() {
        companyFullText.style.display = 'none';
      });
    </script>
  </div>
</div>