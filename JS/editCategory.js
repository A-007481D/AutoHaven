function editCatName(id){
    inp=document.getElementById('catName'+id);

    if(inp.hasAttribute('readonly')){
        inp.removeAttribute('readonly');
    }else{
        inp.setAttribute('readonly',true);

    }

    btn=document.getElementById('btn-'+id);

    if(btn.style.display=='none'){
        btn.style.display='block';
    }else{
        btn.style.display='none';

    }
     
}