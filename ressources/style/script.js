"use strict";
const del = document.querySelectorAll('a[href*="delete]');

if(del.length){
    del.forEach(d=>d.addEventListener("click",e=>{
        il(!confirm("Êtes vous sur(e) de vouloir supprimer cela ?"))
        {

            e.preventDefault();
        }
    }))
}
// version 1 ligne :
// if(del.length)del.forEach(d=>d.addEventListener("click",e=>{if(!confirm("Êtes vous sur(e) 
//de vouloir supprimer cela ?"))e.preventDefault()}));
