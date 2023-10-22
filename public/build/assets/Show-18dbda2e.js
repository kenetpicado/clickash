import{T as g}from"./TableSection-33c2a5bf.js";import{_ as V}from"./AppLayout-9181756d.js";import{c as $}from"./helpers-b8266d48.js";import{t as S}from"./toast-097b2c37.js";import{r as h,o as s,e as _,f as n,b as e,t as o,d,n as x,c as l,h as v,F as p,a as b,O as C,u as R}from"./app-d1da7f39.js";import{_ as q}from"./AddButton-a5733187.js";import{_ as j}from"./FormModal-c58e4b12.js";import{_ as A}from"./SelectForm-3b3fc554.js";import{I as B}from"./IconTrash-18a2c9cf.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./createVueComponent-0705855c.js";import"./IconChevronRight-d062946a.js";const I={class:"title"},T={class:"flex gap-3 overflow-x-auto hide-scrollbar mb-4"},D=e("th",null,"ID",-1),U=e("th",null,"Nombre",-1),E=e("th",null,"Email",-1),F=e("th",null,"Active",-1),z=e("th",null,"Status",-1),H={class:"hover:bg-gray-50"},J={key:0,class:"badge-primary"},L={key:1},M={class:"uppercase"},G={key:0},K=e("td",{colspan:"4",class:"text-center"},"No data to display",-1),P=[K],Q=e("th",null,"ID",-1),W=e("th",null,"Nombre",-1),X=e("th",null,"Settings",-1),Y=e("th",null,"Acciones",-1),Z={class:"hover:bg-gray-50"},ee={class:"font-bold"},te={key:0},se=e("td",{colspan:"5",class:"text-center"},"No data to display",-1),oe=[se],le=e("option",{selected:"",disabled:"",value:""},"Select Raffle",-1),ae=["value"],ye={__name:"Show",props:{user:{type:Object,required:!0},sellers:{type:Object,required:!0},raffles:{type:Object,required:!0},all_raffles:{type:Object,required:!0}},setup(r){const i=r,w=[{name:"Home",route:route("dashboard.users.index")},{name:"Users",route:route("dashboard.users.index")},{name:i.user.name,route:route("dashboard.users.show",i.user.id)}],u=h(0),f=h(!1),c=h(null);function N(k){$({message:"Are you sure you want to delete this raffle?",onConfirm:()=>{C.delete(route("dashboard.users.raffles.destroy",[i.user.id,k]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{S.success("Raffle deleted successfully")}})}})}function y(){c.value=null,f.value=!1}function O(){C.post(route("dashboard.users.raffles.store",i.user.id),{raffle_id:c.value},{onSuccess:()=>{S.success("Raffle added successfully"),y()}})}return(k,a)=>(s(),_(V,{title:"Users",breads:w},{header:n(()=>[e("span",I,o(r.user.name),1),u.value=="raffles"?(s(),_(q,{key:0,onClick:a[0]||(a[0]=t=>f.value=!0)})):d("",!0)]),default:n(()=>[e("div",T,[e("div",{class:x(u.value==0?"active-tab":"inactive-tab"),onClick:a[1]||(a[1]=t=>u.value=0),role:"button"}," Vendedores ",2),e("div",{class:x(u.value==1?"active-tab":"inactive-tab"),onClick:a[2]||(a[2]=t=>u.value=1),role:"button"}," Rifas ",2)]),u.value==0?(s(),_(g,{key:0},{header:n(()=>[D,U,E,F,z]),body:n(()=>[(s(!0),l(p,null,v(r.sellers,(t,m)=>(s(),l("tr",H,[e("td",null,o(m+1),1),e("td",null,o(t.name),1),e("td",null,o(t.email),1),e("td",null,[t.online=="Now"?(s(),l("span",J,o(t.online),1)):(s(),l("span",L,o(t.online),1))]),e("td",null,[e("span",M,o(t.status),1)])]))),256)),r.sellers.length==0?(s(),l("tr",G,P)):d("",!0)]),_:1})):d("",!0),u.value==1?(s(),_(g,{key:1},{header:n(()=>[Q,W,X,Y]),body:n(()=>[(s(!0),l(p,null,v(r.raffles,(t,m)=>(s(),l("tr",Z,[e("td",null,o(m+1),1),e("td",null,[e("span",ee,o(t.name),1)]),e("td",null,[e("pre",null,o(JSON.parse(t.pivot.settings)),1)]),e("td",null,[b(R(B),{role:"button",onClick:ne=>N(t.id)},null,8,["onClick"])])]))),256)),r.raffles.length==0?(s(),l("tr",te,oe)):d("",!0)]),_:1})):d("",!0),b(j,{show:f.value,title:"Raffles",onOnCancel:y,onOnSubmit:O},{default:n(()=>[b(A,{text:"Raffle",modelValue:c.value,"onUpdate:modelValue":a[3]||(a[3]=t=>c.value=t),required:""},{default:n(()=>[le,(s(!0),l(p,null,v(r.all_raffles,t=>(s(),l("option",{value:t.id},o(t.name),9,ae))),256))]),_:1},8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{ye as default};
