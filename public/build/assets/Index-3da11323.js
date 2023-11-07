import{_ as $}from"./AppLayout-f344d739.js";import{T as O}from"./TableSection-56a9fd9b.js";import{_ as T}from"./AddButton-fbdd42be.js";import{_ as j}from"./FormModal-ff07fe4a.js";import{_ as m}from"./InputForm-69a3ad5e.js";import{T as A,r as S,o as a,e as U,f as i,a as r,c as d,h as x,F as f,d as _,u as s,b as o,t as n,k as B,i as E}from"./app-5c7a9679.js";import{_ as k}from"./SelectForm-77f77540.js";import{t as w}from"./toast-633378cc.js";import{c as P}from"./helpers-a5216626.js";import{I as F}from"./IconEye-ca15df4b.js";import{I as R}from"./IconPencil-afc8be81.js";import{I as H}from"./IconTrash-a682585e.js";import"./createVueComponent-44e96f3b.js";import"./IconChevronRight-92c3d40e.js";import"./_plugin-vue_export-helper-c27b6911.js";function L(){const u=A({id:"",name:"",email:"",password:"",password_confirmation:"",sellers_limit:5,company_name:"",role:"owner",status:"enabled"});function y(t=null){u.post(route("dashboard.users.store"),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User created successfully"),t&&t()}})}function h(t=null){u.put(route("dashboard.users.update",u.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User updated successfully"),t&&t()}})}function V(t){P({message:"Are you sure you want to delete this user?",onConfirm:()=>{u.delete(route("dashboard.users.destroy",t),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{w.success("User deleted successfully")}})}})}return{form:u,store:y,update:h,destroy:V}}const M=o("span",{class:"title"}," Users ",-1),z=o("th",null,"ID",-1),D=o("th",null,"Nombre",-1),G=o("th",null,"Company",-1),J=o("th",null,"Sellers",-1),K=o("th",null,"Role",-1),Q=o("th",null,"Active",-1),W=o("th",null,"Status",-1),X=o("th",null,"Accciones",-1),Y={class:"hover:bg-gray-50"},Z={class:"text-gray-400 mt-2"},ee={key:0,class:"badge-primary uppercase"},te={class:"uppercase"},se={class:"flex gap-2 text-gray-400"},oe={key:0},le=o("td",{colspan:"6",class:"text-center"},"No data to display",-1),re=[le],ae=["value"],ne=["value"],Se={__name:"Index",props:{users:{type:Object,required:!0},roles:{type:Object,required:!0},statuses:{type:Object,required:!0}},setup(u){const{destroy:y,store:h,update:V,form:t}=L(),g=[{name:"Home",route:route("dashboard.users.index")},{name:"Users",route:route("dashboard.users.index")}],c=S(!0),p=S(!1);function C(b){Object.assign(t,b),c.value=!1,p.value=!0}function q(){c.value?h(v):V(v)}const v=()=>{t.reset(),p.value=!1,c.value=!0};return(b,l)=>(a(),U($,{title:"Users",breads:g},{header:i(()=>[M,r(T,{onClick:l[0]||(l[0]=e=>p.value=!0)})]),default:i(()=>[r(O,null,{header:i(()=>[z,D,G,J,K,Q,W,X]),body:i(()=>[(a(!0),d(f,null,x(u.users,(e,I)=>(a(),d("tr",Y,[o("td",null,n(I+1),1),o("td",null,[B(n(e.name)+" ",1),o("div",Z,n(e.email),1)]),o("td",null,n(e.company_name),1),o("td",null,n(e.sellers_count)+" / "+n(e.sellers_limit),1),o("td",null,[e.role?(a(),d("span",ee,n(e.role),1)):_("",!0)]),o("td",null,n(e.online),1),o("td",null,[o("span",te,n(e.status),1)]),o("td",null,[o("div",se,[r(s(E),{href:b.route("dashboard.users.show",e.id)},{default:i(()=>[r(s(F))]),_:2},1032,["href"]),r(s(R),{role:"button",onClick:N=>C(e)},null,8,["onClick"]),r(s(H),{role:"button",onClick:N=>s(y)(e.id)},null,8,["onClick"])])])]))),256)),u.users.length==0?(a(),d("tr",oe,re)):_("",!0)]),_:1}),r(j,{show:p.value,title:"User",onOnCancel:v,onOnSubmit:q},{default:i(()=>[r(m,{text:"Name",modelValue:s(t).name,"onUpdate:modelValue":l[1]||(l[1]=e=>s(t).name=e),required:""},null,8,["modelValue"]),r(m,{text:"Email",modelValue:s(t).email,"onUpdate:modelValue":l[2]||(l[2]=e=>s(t).email=e),type:"email",required:""},null,8,["modelValue"]),r(m,{text:"Company name",modelValue:s(t).company_name,"onUpdate:modelValue":l[3]||(l[3]=e=>s(t).company_name=e),required:""},null,8,["modelValue"]),c.value?(a(),d(f,{key:0},[r(m,{text:"Password",modelValue:s(t).password,"onUpdate:modelValue":l[4]||(l[4]=e=>s(t).password=e),type:"password",required:""},null,8,["modelValue"]),r(m,{text:"Password confirmation",modelValue:s(t).password_confirmation,"onUpdate:modelValue":l[5]||(l[5]=e=>s(t).password_confirmation=e),type:"password",required:""},null,8,["modelValue"])],64)):_("",!0),r(m,{text:"Sellers limit",modelValue:s(t).sellers_limit,"onUpdate:modelValue":l[6]||(l[6]=e=>s(t).sellers_limit=e),type:"number"},null,8,["modelValue"]),r(k,{modelValue:s(t).role,"onUpdate:modelValue":l[7]||(l[7]=e=>s(t).role=e),text:"Role"},{default:i(()=>[(a(!0),d(f,null,x(u.roles,e=>(a(),d("option",{value:e},n(e),9,ae))),256))]),_:1},8,["modelValue"]),c.value?_("",!0):(a(),U(k,{key:1,modelValue:s(t).status,"onUpdate:modelValue":l[8]||(l[8]=e=>s(t).status=e),text:"Status"},{default:i(()=>[(a(!0),d(f,null,x(u.statuses,e=>(a(),d("option",{value:e},n(e),9,ne))),256))]),_:1},8,["modelValue"]))]),_:1},8,["show"])]),_:1}))}};export{Se as default};