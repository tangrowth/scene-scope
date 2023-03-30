<div class="company-card">
  <div class="company-card-img"><img src="{{ $company->img_url }}" alt="画像なし"></div>
  <div class="company-cars-content">
    <p>{{ $company->name }}</p>
    <p class="company-text">{{ Str::limit($company->description, 20) }}</p>
    <p class="company-full-text">{{ $company->description }}</p>
  </div>
</div>