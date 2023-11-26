import{_ as $}from"./AppLayout-3e75352a.js";import{T as O}from"./TableSection-7cab68ca.js";import{_ as j}from"./AddButton-f8418b40.js";import{_ as T}from"./FormModal-741a8c2e.js";import{_ as m}from"./InputForm-f2283471.js";import{T as A,r as S,o as a,k as U,g as i,a as r,c as d,f as x,F as f,d as _,u as s,b as o,t as n,j as B,i as E}from"./app-820371dd.js";import{_ as k}from"./SelectForm-5dfee507.js";import{t as w}from"./toast-711cc5a4.js";import{c as M}from"./helpers-ee3a5683.js";import{c as P}from"./createVueComponent-4db92639.js";import{I as F}from"./IconPencil-0e60e40b.js";import{I as R}from"./IconTrash-660011c5.js";import"./IconUsers-d9662313.js";import"./_plugin-vue_export-helper-c27b6911.js";var H=P("eye","IconEye",[["path",{d:"M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0",key:"svg-0"}],["path",{d:"M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6",key:"svg-1"}]]);function L(){const u=A({id:"",name:"",email:"",password:"",password_confirmation:"",sellers_limit:5,company_name:"",role:"owner",status:"enabled"});function y(t=null){u.post(route("dashboard.users.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User created successfully"),t&&t()}})}function h(t=null){u.put(route("dashboard.users.update",u.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User updated successfully"),t&&t()}})}function V(t){M({message:"Are you sure you want to delete this user?",onConfirm:()=>{u.delete(route("dashboard.users.destroy",t),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User deleted successfully")}})}})}return{form:u,store:y,update:h,destroy:V}}const z=o("span",{class:"title"}," Users ",-1),D=o("th",null,"ID",-1),G=o("th",null,"Nombre",-1),J=o("th",null,"Company",-1),K=o("th",null,"Sellers",-1),Q=o("th",null,"Role",-1),W=o("th",null,"Active",-1),X=o("th",null,"Status",-1),Y=o("th",null,"Accciones",-1),Z={class:"hover:bg-gray-50"},ee={class:"text-gray-400 mt-2"},te={key:0,class:"badge-primary uppercase"},se={class:"uppercase"},oe={class:"flex gap-2 text-gray-400"},le={key:0},re=o("td",{colspan:"6",class:"text-center"},"No data to display",-1),ae=[re],ne=["value"],ue=["value"],Se={__name:"Index",props:{users:{type:Object,required:!0},roles:{type:Object,required:!0},statuses:{type:Object,required:!0}},setup(u){const{destroy:y,store:h,update:V,form:t}=L(),g=[{name:"Home",route:route("dashboard.users.index")},{name:"Users",route:route("dashboard.users.index")}],c=S(!0),p=S(!1);function C(b){Object.assign(t,b),c.value=!1,p.value=!0}function q(){c.value?h(v):V(v)}const v=()=>{t.reset(),p.value=!1,c.value=!0};return(b,l)=>(a(),U($,{title:"Users",breads:g},{header:i(()=>[z,r(j,{onClick:l[0]||(l[0]=e=>p.value=!0)})]),default:i(()=>[r(O,null,{header:i(()=>[D,G,J,K,Q,W,X,Y]),body:i(()=>[(a(!0),d(f,null,x(u.users,(e,I)=>(a(),d("tr",Z,[o("td",null,n(I+1),1),o("td",null,[B(n(e.name)+" ",1),o("div",ee,n(e.email),1)]),o("td",null,n(e.company_name),1),o("td",null,n(e.sellers_count)+" / "+n(e.sellers_limit),1),o("td",null,[e.role?(a(),d("span",te,n(e.role),1)):_("",!0)]),o("td",null,n(e.online),1),o("td",null,[o("span",se,n(e.status),1)]),o("td",null,[o("div",oe,[r(s(E),{href:b.route("dashboard.users.show",e.id)},{default:i(()=>[r(s(H))]),_:2},1032,["href"]),r(s(F),{role:"button",onClick:N=>C(e)},null,8,["onClick"]),r(s(R),{role:"button",onClick:N=>s(y)(e.id)},null,8,["onClick"])])])]))),256)),u.users.length==0?(a(),d("tr",le,ae)):_("",!0)]),_:1}),r(T,{show:p.value,title:"User",onOnCancel:v,onOnSubmit:q},{default:i(()=>[r(m,{text:"Name",modelValue:s(t).name,"onUpdate:modelValue":l[1]||(l[1]=e=>s(t).name=e),required:""},null,8,["modelValue"]),r(m,{text:"Email",modelValue:s(t).email,"onUpdate:modelValue":l[2]||(l[2]=e=>s(t).email=e),type:"email",required:""},null,8,["modelValue"]),r(m,{text:"Company name",modelValue:s(t).company_name,"onUpdate:modelValue":l[3]||(l[3]=e=>s(t).company_name=e),required:""},null,8,["modelValue"]),c.value?(a(),d(f,{key:0},[r(m,{text:"Password",modelValue:s(t).password,"onUpdate:modelValue":l[4]||(l[4]=e=>s(t).password=e),type:"password",required:""},null,8,["modelValue"]),r(m,{text:"Password confirmation",modelValue:s(t).password_confirmation,"onUpdate:modelValue":l[5]||(l[5]=e=>s(t).password_confirmation=e),type:"password",required:""},null,8,["modelValue"])],64)):_("",!0),r(m,{text:"Sellers limit",modelValue:s(t).sellers_limit,"onUpdate:modelValue":l[6]||(l[6]=e=>s(t).sellers_limit=e),type:"number"},null,8,["modelValue"]),r(k,{modelValue:s(t).role,"onUpdate:modelValue":l[7]||(l[7]=e=>s(t).role=e),text:"Role"},{default:i(()=>[(a(!0),d(f,null,x(u.roles,e=>(a(),d("option",{value:e},n(e),9,ne))),256))]),_:1},8,["modelValue"]),c.value?_("",!0):(a(),U(k,{key:1,modelValue:s(t).status,"onUpdate:modelValue":l[8]||(l[8]=e=>s(t).status=e),text:"Status"},{default:i(()=>[(a(!0),d(f,null,x(u.statuses,e=>(a(),d("option",{value:e},n(e),9,ue))),256))]),_:1},8,["modelValue"]))]),_:1},8,["show"])]),_:1}))}};export{Se as default};