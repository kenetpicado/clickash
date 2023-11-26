import{_ as $}from"./AppLayout-7786c86a.js";import{T as I}from"./TableSection-75fc069c.js";import{_ as O}from"./AddButton-1bb4bdaf.js";import{_ as j}from"./FormModal-22a0b3fc.js";import{_ as m}from"./InputForm-b6e2c453.js";import{T as E,r as U,o as n,k as S,g as d,a,c as i,f as b,F as f,d as x,u as s,b as l,j as T,t as u,i as A}from"./app-0f5d0684.js";import{_ as k}from"./SelectForm-13967ed9.js";import{t as w}from"./toast-a239a205.js";import{c as B}from"./helpers-9feada8d.js";import{c as M}from"./createVueComponent-32bd6799.js";import{I as P}from"./IconPencil-679fe787.js";import{I as F}from"./IconTrash-662f0455.js";import"./IconUsers-73c793db.js";import"./_plugin-vue_export-helper-c27b6911.js";var H=M("eye","IconEye",[["path",{d:"M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6",key:"svg-1"}]]);function L(){const r=E({id:"",name:"",email:"",password:"",password_confirmation:"",sellers_limit:5,company_name:"",role:"owner",status:"enabled"});function _(t=null){r.post(route("dashboard.users.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User created successfully"),t&&t()}})}function y(t=null){r.put(route("dashboard.users.update",r.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User updated successfully"),t&&t()}})}function V(t){B({message:"Are you sure you want to delete this user?",onConfirm:()=>{r.delete(route("dashboard.users.destroy",t),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User deleted successfully")}})}})}return{form:r,store:_,update:y,destroy:V}}const R=l("span",{class:"title"}," Usuarios ",-1),z=l("th",null,"Nombre",-1),G=l("th",null,"Compañia",-1),J=l("th",null,"Vendedores",-1),K=l("th",null,"Actividad",-1),Q=l("th",null,"Estado",-1),W=l("th",null,"Accciones",-1),X={class:"hover:bg-gray-50"},Y={class:"text-gray-400 mt-2"},Z={class:"uppercase"},D={class:"flex gap-2 text-gray-400"},ee={key:0},te=l("td",{colspan:"6",class:"text-center"},"No data to display",-1),se=[te],oe=["value"],le=["value"],be={__name:"Index",props:{users:{type:Object,required:!0},roles:{type:Object,required:!0},statuses:{type:Object,required:!0}},setup(r){const{destroy:_,store:y,update:V,form:t}=L(),g=[{name:"Home",route:route("dashboard.users.index")},{name:"Users",route:route("dashboard.users.index")}],c=U(!0),p=U(!1);function C(h){Object.assign(t,h),c.value=!1,p.value=!0}function q(){c.value?y(v):V(v)}const v=()=>{t.reset(),p.value=!1,c.value=!0};return(h,o)=>(n(),S($,{title:"Usuarios",breads:g},{header:d(()=>[R,a(O,{onClick:o[0]||(o[0]=e=>p.value=!0)})]),default:d(()=>[a(I,null,{header:d(()=>[z,G,J,K,Q,W]),body:d(()=>[(n(!0),i(f,null,b(r.users,(e,ae)=>(n(),i("tr",X,[l("td",null,[T(u(e.name)+" ",1),l("div",Y,u(e.email),1)]),l("td",null,u(e.company_name),1),l("td",null,u(e.sellers_count)+" / "+u(e.sellers_limit),1),l("td",null,u(e.online),1),l("td",null,[l("span",Z,u(e.status),1)]),l("td",null,[l("div",D,[a(s(A),{href:h.route("dashboard.users.show",e.id)},{default:d(()=>[a(s(H))]),_:2},1032,["href"]),a(s(P),{role:"button",onClick:N=>C(e)},null,8,["onClick"]),a(s(F),{role:"button",onClick:N=>s(_)(e.id)},null,8,["onClick"])])])]))),256)),r.users.length==0?(n(),i("tr",ee,se)):x("",!0)]),_:1}),a(j,{show:p.value,title:"Usuario",onOnCancel:v,onOnSubmit:q},{default:d(()=>[a(m,{text:"Name",modelValue:s(t).name,"onUpdate:modelValue":o[1]||(o[1]=e=>s(t).name=e),required:""},null,8,["modelValue"]),a(m,{text:"Email",modelValue:s(t).email,"onUpdate:modelValue":o[2]||(o[2]=e=>s(t).email=e),type:"email",required:""},null,8,["modelValue"]),a(m,{text:"Company name",modelValue:s(t).company_name,"onUpdate:modelValue":o[3]||(o[3]=e=>s(t).company_name=e),required:""},null,8,["modelValue"]),c.value?(n(),i(f,{key:0},[a(m,{text:"Password",modelValue:s(t).password,"onUpdate:modelValue":o[4]||(o[4]=e=>s(t).password=e),type:"password",required:""},null,8,["modelValue"]),a(m,{text:"Password confirmation",modelValue:s(t).password_confirmation,"onUpdate:modelValue":o[5]||(o[5]=e=>s(t).password_confirmation=e),type:"password",required:""},null,8,["modelValue"])],64)):x("",!0),a(m,{text:"Sellers limit",modelValue:s(t).sellers_limit,"onUpdate:modelValue":o[6]||(o[6]=e=>s(t).sellers_limit=e),type:"number"},null,8,["modelValue"]),a(k,{modelValue:s(t).role,"onUpdate:modelValue":o[7]||(o[7]=e=>s(t).role=e),text:"Role"},{default:d(()=>[(n(!0),i(f,null,b(r.roles,e=>(n(),i("option",{value:e},u(e),9,oe))),256))]),_:1},8,["modelValue"]),c.value?x("",!0):(n(),S(k,{key:1,modelValue:s(t).status,"onUpdate:modelValue":o[8]||(o[8]=e=>s(t).status=e),text:"Status"},{default:d(()=>[(n(!0),i(f,null,b(r.statuses,e=>(n(),i("option",{value:e},u(e),9,le))),256))]),_:1},8,["modelValue"]))]),_:1},8,["show"])]),_:1}))}};export{be as default};
