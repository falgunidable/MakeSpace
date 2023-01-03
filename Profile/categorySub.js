function subCategory(category,subcategory) {
    var fur = ['Tables', 'Cabinet', 'Chair & Seating','Kids Furniture','Storage & Display','Bedroom Furniture'];
    var elect = ['Coolers', 'TV & Audio', 'Photography','Office Electronics','Computers & Accessories'];

    switch (category.value) {
        case 'Furniture':
            subcategory.options.length = 0;
            for (i = 0; i < fur.length; i++) {
                createOption(subcategory, fur[i], fur[i]);
            }
            break;
        case 'Electronics':
            subcategory.options.length = 0;
            for (i = 0; i < elect.length; i++) {
                createOption(subcategory, elect[i], elect[i]);
            }
            break;
            default:
                subcategory.options.length = 0;
            break;
    }

}
    function createOption(ddl, text, value) {
        var opt = document.createElement('option');
        opt.value = value;
        opt.text = text;
        ddl.options.add(opt);
    }

function subTypeCategory(category,subcategory){
    var table = ['Study Desks','Dinning Table','Center Table','Nested Table','Stools'];
    var cabinet = ['TV & Entertainment Units', 'Bookcases','Kitchen Cabinet'];
    var seat = ['Office Chairs', 'Gaming Chairs', 'Sofa Set','L-Shape Sofa','Sofa Beds','Chairs','Swing Chairs','Bean Bags'];
    var storage = ['Shoe Rack','Wall Shelves','Wardrobe'];
    var photo = ['Camera Cases & Bags','Tripods','Camera Lenses','Binoculars'];
    var ca = ['PCs','Laptop','Mouse','Phone','iPad'];

    switch (category.value) {
        case 'Tables':
            subcategory.options.length = 0;
            for (i = 0; i < table.length; i++) {
                createOption(subcategory, table[i], table[i]);
            }
            break;
        case 'Cabinet':
            subcategory.options.length = 0;
            for (i = 0; i < cabinet.length; i++) {
                createOption(subcategory, cabinet[i], cabinet[i]);
            }
            break;
        case 'Chair & Seating':
            subcategory.options.length = 0;
            for (i = 0; i < seat.length; i++) {
                createOption(subcategory, seat[i], seat[i]);
            }
            break;
        case 'Photography':
            subcategory.options.length = 0;
            for (i = 0; i < photo.length; i++) {
                createOption(subcategory, photo[i], photo[i]);
            }
            break;
        case 'Storage & Display':
            subcategory.options.length = 0;
            for (i = 0; i < storage.length; i++) {
                createOption(subcategory, storage[i], storage[i]);
            }
            break;
        case 'Computers & Accessories':
            subcategory.options.length = 0;
            for (i = 0; i < ca.length; i++) {
                createOption(subcategory, ca[i], ca[i]);
            }
            break;
            default:
                subcategory.options.length = 0;
            break;
        
    }
}