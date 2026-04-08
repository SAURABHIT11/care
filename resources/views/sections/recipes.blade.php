<section id="recipes" class="recipe-section">
    <div class="container">

        <div class="text-center mb-5">
            <div class="section-tag"><i class="bi bi-egg-fried"></i> Nutritious Recipes</div>
            <h2 class="section-title">Delicious Bites for <span>Growing Kids</span></h2>
            <p class="text-muted mt-2">Age-appropriate, allergy-aware, and absolutely kid-approved!</p>
        </div>

        <div class="row g-4">

            @forelse($recipes as $recipe)

                @php
                    // get first image file
                    $image = $recipe->files->first(function ($file) {
                        return str_starts_with($file->file_type, 'image');
                    });
                @endphp

                <div class="col-sm-6 col-lg-3">
                    <div class="recipe-card h-100 open-recipe" data-id="{{ $recipe->id }}" style="cursor:pointer;">

                        {{-- IMAGE --}}
                        @if($image)
                            <img src="{{ asset('storage/' . $image->file_path) }}" class="img-fluid w-100 mb-2"
                                style="height:150px; object-fit:cover; border-radius:10px;">
                        @else
                            <div class="text-center py-4">🍽️</div>
                        @endif

                        {{-- TITLE --}}
                        <div class="recipe-title">
                            {{ \Str::limit($recipe->title, 40) }}
                        </div>

                        {{-- DESCRIPTION --}}
                        <p style="font-size:.85rem;color:#888;margin:.5rem 0;">
                            {{ \Str::limit($recipe->description, 60) }}
                        </p>

                        {{-- META --}}
                        <div class="recipe-info">
                            <span class="rinfo">
                                <i class="bi bi-clock"></i>
                                {{ $recipe->difficulty ?? 'Easy' }}
                            </span>

                            <span class="rinfo">
                                <i class="bi bi-fire"></i>
                                {{ rand(80, 300) }} kcal
                            </span>
                        </div>

                        {{-- BADGE --}}
                        @if($recipe->is_featured)
                            <div class="nutrition-badge">
                                <i class="bi bi-star-fill"></i> Featured Recipe
                            </div>
                        @endif

                    </div>
                </div>

            @empty

                <div class="col-12 text-center text-muted">
                    No recipes available
                </div>

            @endforelse

        </div>
        {{-- VIEW ALL --}}
        <div class="text-center mt-5">
            <a href="{{ route('recipes.index') }}" class="btn-hero">
                See All Recipes <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="modal fade" id="recipeModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="recipeTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- IMAGE --}}
                    <img id="recipeImage" class="img-fluid mb-3" style="display:none; border-radius:10px;">

                    {{-- CONTENT --}}
                    <div id="recipeContent"></div>

                </div>

            </div>
        </div>
    </div>
    <script>
const recipeUrl = "{{ route('recipe.data', ':id') }}";

document.addEventListener('click', function(e){

    let card = e.target.closest('.open-recipe');

    if(card){

        let id = card.dataset.id;
        let url = recipeUrl.replace(':id', id);

        document.getElementById('recipeContent').innerHTML = "Loading...";
        document.getElementById('recipeTitle').innerText = "";

        fetch(url)
            .then(res => res.json())
            .then(data => {

                document.getElementById('recipeTitle').innerText = data.title;
                document.getElementById('recipeContent').innerHTML = data.content;

                let img = document.getElementById('recipeImage');

                if(data.image){
                    img.src = data.image;
                    img.style.display = 'block';
                } else {
                    img.style.display = 'none';
                }

                let modal = new bootstrap.Modal(document.getElementById('recipeModal'));
                modal.show();
            });
    }

});
</script>
<script>
document.getElementById('recipeModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('recipeContent').innerHTML = '';
});
</script>
</section>