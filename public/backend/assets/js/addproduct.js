$(document).ready(function() {
    // Initialize Select2 on category select
    $('#category_id').select2();

    $('#category_id').change(function() {
        const categoryId = $(this).val();
        $('.Sub_Categories').empty();
        $('.specification_key').empty();
        $('#add-another').hide();

        if (categoryId) {
            fetchSubCategories(categoryId, 1, $(this));
            fetchSpecifications(categoryId);
        }
    });

    function fetchSubCategories(parentId, level, parentSelect) {
        $.ajax({
            url: `/admin/product/create?parent_id=${parentId}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.subs && data.subs.length > 0) {
                    appendSubCategories(data.subs, level, parentSelect);
                }
            }
        });
    }

    function appendSubCategories(subCategories, level, parentSelect) {
        const subCategoryDiv = $('.Sub_Categories');
        const categoryGroup = $('<div>', {
            class: 'subcategory-group mb-3'
        });

        const select = $('<select>', {
            name: 'category_id[]',
            class: 'form-control select mb-2',
            required:true,
            'data-level': level
        });

        const selectLabel = '--Select ' + 'Sub '.repeat(level) + 'Category--';
        select.append(`<option value="" disabled selected>${selectLabel}</option>`);

        $.each(subCategories, function(index, sub) {
            select.append(`<option value="${sub.id}">${'-'.repeat(level)} ${sub.name}</option>`);
        });

        categoryGroup.append(select);
        subCategoryDiv.append(categoryGroup);

        // Initialize Select2 on new subcategory select
        select.select2();

        select.change(function() {
            const selectedSubCategoryId = $(this).val();
            if (selectedSubCategoryId) {
                fetchSubCategories(selectedSubCategoryId, level + 1, $(this));
                fetchSpecifications($(this).closest('.subcategory-group').find('select:first')
                    .val());
            }
        });
    }

    function fetchSpecifications(categoryId) {
        if (categoryId) {
            $.ajax({
                url: `/admin/products/specifications`,
                type: 'GET',
                data: {
                    category_id: categoryId
                },
                dataType: 'json',
                success: function(data) {
                    appendSpecifications(data.keys);
                }
            });
        }
    }

    function appendSpecifications(specifications) {
        $('.specification_key').empty();
        const specificationKeyDiv = $('.specification_key');

        const specDiv = createSpecificationDiv(specifications);
        specificationKeyDiv.append(specDiv);
        $('#add-another').show();
    }

    function createSpecificationDiv(specifications) {
        const specDiv = $('<div>', {
            class: 'form-group mb-3 specification-group'
        });
        const label = $('<label>', {
            text: 'Select Specifications',
            for: 'specification_key'
        });
        specDiv.append(label);

        const specSelect = $('<select>', {
            name: 'specification_key[][key_id]',
            class: 'form-control mb-2',
            'data-key-id': 'key_' + Date.now(),
            required: true
        });

        specSelect.append('<option value="" disabled selected>--Select Specification--</option>');
        $.each(specifications, function(index, spec) {
            specSelect.append(`<option value="${spec.id}">${spec.name}</option>`);
        });

        specDiv.append(specSelect);

        // Initialize Select2 on the specification select
        specSelect.select2({
            width: '100%',
        });

        const addTypeButton = $('<button>', {
            class: 'btn btn-secondary btn-sm mt-2 add-type',
            text: 'Add Type',
            type:'button',
            style: 'display:none;'
        });
        specDiv.append(addTypeButton);

        // Remove Specification Button (hidden initially)
        const removeSpecButton = $('<button>', {
            class: 'btn btn-danger btn-sm mt-2 remove-specification',
            text: 'Remove Specification',
            style: 'display:none;' // Initially hidden
        });
        specDiv.append(removeSpecButton);

        // Change event for the specification select
        specSelect.change(function() {
            const selectedSpecId = $(this).val();
            specDiv.find('.types-group').remove();

            if (selectedSpecId) {
                fetchTypes(selectedSpecId, specDiv);
                addTypeButton.show();
            } else {
                addTypeButton.hide();
            }
        });

        // Button click event for adding a new type
        addTypeButton.click(function() {
            const newTypeDiv = $('<div>', {
                class: 'form-group mb-3 types-group row'
            });

            newTypeDiv.append('<div class="col-4"></div>'); // Empty div for button alignment

            // Fetch types based on the current specification
            const currentSpecId = specSelect.val();
            fetchTypes(currentSpecId, newTypeDiv);

            // Add Remove Type Button
            const removeTypeButton = $('<button>', {
                class: 'btn btn-danger btn-sm mt-2 col-4 remove-type',
                type:'button',
                text: 'Remove Type'
            });
            newTypeDiv.append(removeTypeButton);
            specDiv.append(newTypeDiv);

            // Initialize Select2 on new type select
            const typeSelect = newTypeDiv.find('select');
            typeSelect.select2();

            typeSelect.change(function() {
                const selectedTypeId = $(this).val();
                newTypeDiv.find('.attributes-group').remove();
                if (selectedTypeId) {
                    fetchAttributes(selectedTypeId, newTypeDiv);
                }
            });

            // Remove Type Button Click Event
            removeTypeButton.click(function() {
                newTypeDiv.remove();
                // Hide removeSpecButton if no types left
                if (specDiv.find('.types-group').length === 0) {
                    removeSpecButton.hide();
                }
            });

            // Show Remove Specification button if there's at least one type
            if (specDiv.find('.types-group').length > 0) {
                removeSpecButton.show();
            }
        });

        return specDiv;
    }

    function fetchTypes(specId, parentDiv) {
        $.ajax({
            url: `/admin/products/specifications`,
            type: 'GET',
            data: {
                key_id: specId
            },
            dataType: 'json',
            success: function(data) {
                appendTypes(data.types, parentDiv);
            }
        });
    }

    function appendTypes(types, parentDiv) {
        const typesDiv = $('<div>', {
            class: 'form-group mb-3 types-group'
        });
        const label = $('<label>', {
            text: 'Select Types'
        });
        typesDiv.append(label);

        const typeSelect = $('<select>', {
            name: 'specification_key[][type_id]',
            class: 'form-control mb-2 col-8',
            required:true,
            'data-type-id': 'type_' + Date.now()
        });

        typeSelect.append('<option value="" disabled selected>--Select Type--</option>');
        $.each(types, function(index, type) {
            typeSelect.append(`<option value="${type.id}">${type.name}</option>`);
        });

        typesDiv.append(typeSelect);
        parentDiv.append(typesDiv);

        // Initialize Select2 on the type select
        typeSelect.select2();

        typeSelect.change(function() {
            const selectedTypeId = $(this).val();
            typesDiv.find('.attributes-group').remove();
            if (selectedTypeId) {
                fetchAttributes(selectedTypeId, typesDiv);
            }
        });
    }

    function fetchAttributes(typeId, parentDiv) {
        $.ajax({
            url: `/admin/products/specifications`,
            type: 'GET',
            data: {
                type_id: typeId
            },
            dataType: 'json',
            success: function(data) {
                appendAttributes(data.attributes, parentDiv);
            }
        });
    }

    function appendAttributes(attributes, parentDiv) {
        const attributesDiv = $('<div>', {
            class: 'form-group mb-3 attributes-group'
        });
        const label = $('<label>', {
            text: 'Select Attributes'
        });
        attributesDiv.append(label);

        const attrSelect = $('<select>', {
            name: 'specification_key[][attribute_id]',
            class: 'form-control mb-2 col-8',
            required:true,
        });

        attrSelect.append('<option value="" disabled selected>--Select Attribute--</option>');
        $.each(attributes, function(index, attr) {
            attrSelect.append(`<option value="${attr.id}">${attr.name}</option>`);
        });

        attributesDiv.append(attrSelect);
        parentDiv.append(attributesDiv);

        // Initialize Select2 on the attribute select
        attrSelect.select2();
    }

    $('#add-another').click(function() {
        // Get the last selected category_id from category_id[]
        const categoryIds = $('select[name="category_id[]"]').map(function() {
            return $(this).val();
        }).get(); // Get all selected values

        const categoryId = categoryIds[categoryIds.length - 1]; // Get the last value

        const newSpecDiv = $('<div>', {
            class: 'form-group mb-3 specification-group'
        });

        // Create label for specifications
        const label = $('<label>', {
            text: 'Select Specifications',
            for: 'specification_key',
            required:true,
        });
        newSpecDiv.append(label);

        // Create new specification select
        const specSelect = $('<select>', {
            name: 'specification_key[][key_id]',
            class: 'form-control mb-2 select',
            'data-key-id': 'key_' + Date.now(),
            required: true
        });

        specSelect.append('<option value="" disabled selected>--Select Specification--</option>');

        // Fetch specifications from the server based on the last category ID
        if (categoryId) {
            $.ajax({
                url: '/admin/products/specifications',
                type: 'GET',
                data: {
                    category_id: categoryId
                },
                dataType: 'json',
                success: function(data) {
                    $.each(data.keys, function(index, spec) {
                        specSelect.append(
                            `<option value="${spec.id}">${spec.name}</option>`
                        );
                    });

                    // Initialize Select2 on the new specification select
                    specSelect.select2({
                        width: '100%'
                    });
                }
            });
        }

        newSpecDiv.append(specSelect);

        // Create Add Type Button
        const addTypeButton = $('<button>', {
            class: 'btn btn-secondary btn-sm mt-2 add-type',
            text: 'Add Type',
            type:'button',
            style: 'display:none;' // Initially hidden
        });
        newSpecDiv.append(addTypeButton);

        // Create Remove Specification Button
        const removeSpecButton = $('<button>', {
            class: 'btn btn-danger btn-sm mt-2 remove-specification',
            type:'button',
            text: 'Remove Specification'
        });
        newSpecDiv.append(removeSpecButton);

        // Change event for the specification select
        specSelect.change(function() {
            const selectedSpecId = $(this).val();
            newSpecDiv.find('.types-group').remove(); // Clear existing types

            if (selectedSpecId) {
                fetchTypes(selectedSpecId, newSpecDiv);
                addTypeButton.show();
            } else {
                addTypeButton.hide();
            }
        });

        // Click event for adding a new type
        addTypeButton.click(function() {
            const newTypeDiv = $('<div>', {
                class: 'form-group mb-3 types-group row'
            });

            newTypeDiv.append('<div class="col-4"></div>'); // Empty div for alignment

            // Create type select
            const typeSelect = $('<select>', {
                name: 'specification_key[][type_id]',
                class: 'form-control mb-2 col-8 select',
                'data-type-id': 'type_' + Date.now(),
                required:true,
            });

            typeSelect.append(
                '<option value="" disabled selected>--Select Type--</option>');

            // Fetch types based on the selected specification
            const currentSpecId = specSelect.val();
            fetchTypes(currentSpecId, typeSelect); // Fetch types and append directly

            newTypeDiv.append(typeSelect);

            // Add Remove Type Button
            const removeTypeButton = $('<button>', {
                class: 'btn btn-danger btn-sm mt-2 col-4 mx-auto remove-type',
                type:'button',
                text: 'Remove Type'
            });
            newTypeDiv.append(removeTypeButton);
            newSpecDiv.append(newTypeDiv);

            // Initialize Select2 for the type select
            typeSelect.select2({
                width: '100%'
            });

            // Change event for the type select
            typeSelect.change(function() {
                const selectedTypeId = $(this).val();
                newTypeDiv.find('.attributes-group').remove();
                if (selectedTypeId) {
                    fetchAttributes(selectedTypeId, newTypeDiv);
                }
            });

            // Remove Type Button Click Event
            removeTypeButton.click(function() {
                newTypeDiv.remove();
                // Hide removeSpecButton if no types left
                if (newSpecDiv.find('.types-group').length === 0) {
                    addTypeButton.hide();
                }
            });
        });

        // Remove Specification button functionality
        removeSpecButton.click(function() {
            newSpecDiv.remove();
        });

        // Append new specification group
        $('.specification_key').append(newSpecDiv);
    });



});