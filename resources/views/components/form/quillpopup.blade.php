<div class="quillPopup w-3xl">
    <x-form.field type="select" label="Lien vers la page" name="page-selection" :options="\App\Models\Page::select('id', 'title')->get()->pluck('title', 'pageHashid')->toArray()"/>
    <button class="quillPopup-cancel inline-flex justify-center mt-3 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white hover:bg-s3">
        Annuler
    </button>
    <button class="quillPopup-save inline-flex justify-center mt-3 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Hop c'est bon
    </button>
</div>