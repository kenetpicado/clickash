import{_ as N}from"./AddButton-67aa06b1.js";import{_ as f}from"./InputForm-9c83281e.js";import{_ as $}from"./FormModal-2ee5cb69.js";import{T as q,r as y,o as m,e as z,f as d,a as n,c as _,h as A,F as k,d as x,u as s,b as e,k as T,t as V,i as B}from"./app-4678c2f9.js";import{t as u}from"./toast-222764f6.js";import{c as O,I as U}from"./helpers-216f0a78.js";import{_ as j}from"./AppLayout-a1a5b8b9.js";import{T as F}from"./TableSection-cddd6cd9.js";import{I as L}from"./IconEye-0b872b07.js";import{I as G}from"./IconEdit-ea038fb8.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./createVueComponent-c8464d70.js";import"./IconChevronRight-b2c5f8b2.js";function M(){const a=q({id:"",name:"",email:"",password:"",password_confirmation:""});function g(r=null){if(a.password!==a.password_confirmation){u.error("Las contraseñas no coinciden");return}a.post(route("clientarea.sellers.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Guardado correctamente"),r&&r()},onError:i=>{u.error(i.message),r&&r()}})}function h(r=null){a.put(route("clientarea.sellers.update",a.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Actualizado correctamente"),r&&r()}})}function o(r=null){a.put(route("clientarea.toggle-status",a.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Actualizado correctamente"),r&&r()}})}function b(r){O({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{a.delete(route("clientarea.sellers.destroy",r),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{u.success("Eliminado correctamente")}})}})}return{form:a,store:g,update:h,destroy:b,toggleStatus:o}}const H=e("span",{class:"title"}," Vendedores ",-1),J=e("th",null,"Nombre",-1),K=e("th",null,"Actividad",-1),P=e("th",null,"Estado",-1),Q=e("th",null,"Acciones",-1),R={class:"text-gray-400"},W={class:"text-xs whitespace-nowrap badge-green"},X={class:"relative inline-flex items-center cursor-pointer"},Y=["checked","onChange"],Z=e("div",{class:"w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:indigo-4 peer-focus:indigo-indigo-300 dark:peer-focus:indigo-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gray-800"},null,-1),D={class:"flex items-center gap-3"},ee=["onClick"],te=["onClick"],re={key:0},oe=e("td",{colspan:"4",class:"text-center"},"No hay datos",-1),se=[oe],be={__name:"Index",props:{sellers:{type:Object,required:!0}},setup(a){const{store:g,update:h,form:o,toggleStatus:b,destroy:r}=M(),i=y(!0),S=[{name:"Inicio",route:route("clientarea.index")},{name:"Vendedores",route:route("clientarea.sellers.index")}],p=y(!1);function C(){i.value?g(v):h(v)}const v=()=>{o.reset(),p.value=!1,i.value=!0};function E(c){i.value=!1,Object.assign(o,c),p.value=!0}function I(c){o.id=c,b()}return(c,l)=>(m(),z(j,{title:"Vendedores",breads:S},{header:d(()=>[H,n(N,{onClick:l[0]||(l[0]=t=>p.value=!0)})]),default:d(()=>[n(F,null,{header:d(()=>[J,K,P,Q]),body:d(()=>[(m(!0),_(k,null,A(a.sellers,t=>(m(),_("tr",null,[e("td",null,[T(V(t.name)+" ",1),e("div",R,V(t.email),1)]),e("td",null,[e("span",W,V(t.online),1)]),e("td",null,[e("label",X,[e("input",{type:"checkbox",class:"sr-only peer",checked:t.status=="enabled",onChange:w=>I(t.id)},null,40,Y),Z])]),e("td",null,[e("div",D,[n(s(B),{href:c.route("clientarea.sellers.show",t.id),tooltip:"Ventas"},{default:d(()=>[n(s(L),{size:"22"})]),_:2},1032,["href"]),e("span",{tooltip:"Editar",role:"button",onClick:w=>E(t)},[n(s(G),{size:"22"})],8,ee),e("span",{tooltip:"Eliminar",role:"button",onClick:w=>s(r)(t.id)},[n(s(U),{size:"22"})],8,te)])])]))),256)),a.sellers.length==0?(m(),_("tr",re,se)):x("",!0)]),_:1}),n($,{show:p.value,title:"Vendedor",onOnCancel:v,onOnSubmit:C},{default:d(()=>[n(f,{text:"Nombre",modelValue:s(o).name,"onUpdate:modelValue":l[1]||(l[1]=t=>s(o).name=t),required:""},null,8,["modelValue"]),n(f,{text:"Correo",modelValue:s(o).email,"onUpdate:modelValue":l[2]||(l[2]=t=>s(o).email=t),type:"email",required:""},null,8,["modelValue"]),i.value?(m(),_(k,{key:0},[n(f,{text:"Contraseña",modelValue:s(o).password,"onUpdate:modelValue":l[3]||(l[3]=t=>s(o).password=t),type:"password",required:""},null,8,["modelValue"]),n(f,{text:"Confirmar contraseña",modelValue:s(o).password_confirmation,"onUpdate:modelValue":l[4]||(l[4]=t=>s(o).password_confirmation=t),type:"password",required:""},null,8,["modelValue"])],64)):x("",!0)]),_:1},8,["show"])]),_:1}))}};export{be as default};