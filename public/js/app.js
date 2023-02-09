

function editplat(plat){
    let nameinp = document.getElementById('nameinp')
    let priceinp = document.getElementById('priceinp')
    let descriptioninp = document.getElementById('descriptioninp')
    let categoryinp = document.getElementById('categoryinp')
    let form = document.getElementById('menuform')
    // console.log(nameinp,priceinp,descriptioninp,categoryinp);
    nameinp.value = plat.name
    priceinp.value = plat.price
    descriptioninp.value = plat.description
    categoryinp.value = plat.category
    // form.removeAttribute('action')
    form.setAttribute('action',"http://feane.com/menu/"+plat.id)
}


function changepassword(formid){
       let form = document.getElementById(formid)
       let inputs = form.children
    //    console.log(inputs);
       Array.from(inputs).forEach(input => {
        input.firstElementChild.removeAttribute('disabled')
        console.log(input);

       });
       form.innerHTML+=`
       <div class="form-floating">
                      <input type="submit" class="btn  btn-info w-100 mt-2" id="" placeholder=" " value="Save Changes" name="submit">
                  </div>
       `

}
