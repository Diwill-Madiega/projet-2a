// public/js/collection.js

$(document).ready(function() {
    var $collectionHolder = $('div.devis-lines');
    var $addNewItem = $('#add-item');

    // setup an "add a new item" button
    $collectionHolder.data('index', $collectionHolder.find('.form-group').length);

    $addNewItem.on('click', function(e) {
        e.preventDefault();

        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');
        var index = $collectionHolder.data('index');
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in a div, before the "add new item" link
        var $newFormLi = $('<div class="form-group row mb-3"></div>').append(newForm);
        $addNewItem.before($newFormLi);
    });

    $collectionHolder.on('click', '.remove-item', function(e) {
        e.preventDefault();
        $(this).closest('.form-group').remove();
    });
});