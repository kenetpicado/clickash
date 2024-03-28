import{_ as b,a as h}from"./DropdownItem-b62aa329.js";import{_ as x}from"./InputForm-b3d4eebc.js";import{_ as k}from"./SelectForm-a3d3b0fe.js";import{_ as w}from"./FormModal-2c969207.js";import{_ as O}from"./ClientareaLayout-cae29f17.js";import{c as S}from"./helpers-ee1dd732.js";import{t as g}from"./toast-a35b6174.js";import{r as E,T as V,o as n,k as $,f as i,d as e,t as l,b as a,c as d,F as C,l as T,u as m,O as j}from"./app-b9c931a0.js";import{_ as I}from"./WeekResume-cb4b31bc.js";import{I as q}from"./IconTrash-8e83b230.js";import"./createVueComponent-5a0326f8.js";import"./Modal-36832df0.js";import"./useAuth-6ae4d293.js";import"./IconUser-5bef4d49.js";const R={class:"title"},B={class:"grid grid-cols-1 lg:grid-cols-2 gap-4 text-gray-600 mb-6"},M={class:"flex items-center justify-between mb-4 text-gray-600"},N=e("span",{class:"title"}," Movimientos ",-1),D={key:0,class:"text-center text-gray-400 mb-4"},F={key:1,class:"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4"},P={class:"bg-gray-100 p-3 rounded-lg"},U={class:"flex items-center justify-between"},A={class:"text-gray-400 text-sm mb-2"},L={class:"px-1 py-1"},z={class:"flex items-center justify-between"},G={class:"text-sm text-gray-600 font-bold"},H={class:"text-xl text-gray-600 font-bold"},J=e("option",{value:"RETIRO"},"RETIRO",-1),K=e("option",{value:"DEPOSITO"},"DEPOSITO",-1),me={__name:"Show",props:{movements:{type:Object,required:!0},seller:{type:Object,required:!0},week:{type:String,required:!0},week_resume:{type:Object,required:!0}},setup(s){const u=s,_=E(!1),o=V({id:null,type:"RETIRO",week:u.week,amount:null});function f(){o.reset(),_.value=!1}function v(){o.post(route("clientarea.sellers.archings.store",u.seller.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{f(),g.success("Movimiento agregado")},onError:c=>{console.log(c)}})}function y(c){S({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{j.delete(route("clientarea.sellers.archings.destroy",[u.seller.id,c]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{g.success("Eliminado correctamente")}})}})}return(c,r)=>(n(),$(O,{title:"Caja"},{header:i(()=>{var t,p;return[e("span",R,l(s.seller.name)+": "+l((p=(t=s.week_resume)==null?void 0:t.data)==null?void 0:p.week_label),1)]}),default:i(()=>[e("div",B,[a(I,{week:s.week_resume.data},null,8,["week"])]),e("div",M,[N,e("button",{onClick:r[0]||(r[0]=t=>_.value=!0),type:"button",class:"primary-button"}," Nuevo ")]),s.movements.data.length==0?(n(),d("div",D," No hay movimientos ")):(n(),d("div",F,[(n(!0),d(C,null,T(s.movements.data,t=>(n(),d("div",P,[e("div",U,[e("div",A,l(t.created_at),1),a(h,null,{default:i(()=>[e("div",L,[a(b,{onClick:p=>y(t.id),title:"Eliminar",icon:m(q)},null,8,["onClick","icon"])])]),_:2},1024)]),e("div",z,[e("span",G,l(t.type),1),e("span",H,l(t.amount),1)])]))),256))])),a(w,{show:_.value,title:"Movimiento",onOnCancel:f,onOnSubmit:v},{default:i(()=>[a(k,{modelValue:m(o).type,"onUpdate:modelValue":r[1]||(r[1]=t=>m(o).type=t),text:"Tipo",required:""},{default:i(()=>[J,K]),_:1},8,["modelValue"]),a(x,{modelValue:m(o).amount,"onUpdate:modelValue":r[2]||(r[2]=t=>m(o).amount=t),type:"number",text:"Cantidad",required:""},null,8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{me as default};