//Shopify integration
//variables
var shop_options = {
    product: {
        iframe: false,
        contents: {
            img: false,
            imgWithCarousel: false,
            title: false,
            variantTitle: false,
            price: false,
            options: false,
            quantity: false,
            quantityIncrement: false,
            quantityDecrement: false,
            quantityInput: false,
            button: true,
            buttonWithQuantity: false,
            description: false,
        },
        text: {
            button: 'SHOP',
            outOfStock: 'OUT OF STOCK',
            unavailable: 'Unavailable',
        },
        classes: {            
            button: 'shopify-buy__btn home-catalogo-buy',            
        },
    },
    cart: {
        styles: {
            button: {
                'color': 'red',
                ':hover': {
                    'color': 'orange'
                }
            }
        }
    },
    modal: {}, // configure the modal created by a product embed
    productSet: {}, // configure a collection or set of products
    toggle: {}, // configure the tab that toggles the cart open
    modalProduct: {}, // configure the product within the modal
    option: {}, // configure the variant option selectors within a product
    lineItem: {}, // configure the individual line items within a cart
}


// Fetching Products----------------------------------------------------------

// Fetch all products in your shop
function fetchAllProduct(){
    client.product.fetchAll().then((products) => {
        // Do something with the products
        console.log(products);
    });
}


// Fetch a single product by ID
function fetchProduct(id){
    productId = id.toString();

    client.product.fetch(productId).then((product) => {
        // Do something with the product
        console.log(product);
    });
}

// Fetching Collection--------------------------------------------------------

// Fetch all collections, including their products
function fetchAllCollections(){
    client.collection.fetchAllWithProducts().then((collections) => {
      // Do something with the collections
      console.log(collections);
    });
}

// Fetch a single collection by ID, including its products
function fetchCollection(id){
    collectionId = id.toString();
    client.collection.fetchWithProducts(collectionId).then((collection) => {
        // Do something with the collection
        console.log(collection);
    });
}

// Checkout -------------------------------------------------------------------

// Create an empty checkout
function createCheckout(){
    client.checkout.create().then((checkout) => {
      // Do something with the checkout
      console.log(checkout);
        return checkout.id
    });
}

// Add Item To Checkout
function addItemCheckout(checkoutId, itemID, quantity){
    lineItemsToAdd = [
      {variantId: itemID, quantity: quantity}
    ];

    // Add an item to the checkout
    client.checkout.addLineItems(checkoutId, lineItemsToAdd).then((checkout) => {
      // Do something with the updated checkout
      console.log(checkout.lineItems); // Array with one additional line item
    });
}

// Update Checkout
function updateCheckout(checkoutId, itemID, quantity){
    lineItemsToUpdate = [
      {id: itemID, quantity: quantity}
    ];

    // Update the line item on the checkout (change the quantity or variant)
    client.checkout.updateLineItems(checkoutId, lineItemsToUpdate).then((checkout) => {
      // Do something with the updated checkout
      console.log(checkout.lineItems); // Quantity of line item 
    });
}

// Remove Item from Checkout
function removeItemCheckout(checkoutId, itemID){
    lineItemIdsToRemove = [
      itemID
    ];

    // Remove an item from the checkout
    client.checkout.removeLineItems(checkoutId, lineItemIdsToRemove).then((checkout) => {
      // Do something with the updated checkout
      console.log(checkout.lineItems); // Checkout with line item 
    });
}

// Fetch Checkout
function fetchCheckout(checkoutId){

        client.checkout.fetch(checkoutId).then((checkout) => {
        // Do something with the checkout
        console.log(checkout);
        return checkout.url
    });
}