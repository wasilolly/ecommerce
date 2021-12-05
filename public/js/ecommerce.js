
window.onload = function(){
    
    const plusButton = document.getElementById("plus");
    const minusButton = document.getElementById("minus");

    plusButton.addEventListener('click', addone)
    minusButton.addEventListener('click', minusone)


    function addone(){
        const qtyInput = document.getElementById("unit");
        oldQty = parseFloat(qtyInput.innerText);
        qtyInput.innerText = oldQty + 1;
    }

    function minusone(){
        const qtyInput = document.getElementById("unit");
        oldQty = parseFloat(qtyInput.innerText);
        //return, qty can't be less than one
        if(oldQty === 1){
            return
        }else{
            qtyInput.innerText = oldQty - 1;
        }
    }
   
}
