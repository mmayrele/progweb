//Javascript

document.addEventListener('DOMContentLoaded', function() {
 
    document.getElementById('SaveFormJson')?.addEventListener('click', function() {
        if( localStorage.getItem('productToEdit')){
            localStorage.removeItem('productToEdit');
        }
        
        const form = document.getElementsByTagName("form")[0];
        const producto = Object.fromEntries(new FormData(form).entries());

        fetch('http://api.proyecto.com/product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(producto)
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Producto agregado exitosamente');
            }
            document.location = "http://proyecto.com/portafolio.html";
        })
        .catch(error => {
            console.error('Error:', error);
        });

        return false;
    });

});