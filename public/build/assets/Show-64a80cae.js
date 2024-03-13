import{_ as b,a as h}from"./DropdownItem-ca908a48.js";import{_ as x}from"./InputForm-48634172.js";import{_ as k}from"./SelectForm-068445b4.js";import{_ as w}from"./FormModal-da0ba5f7.js";import{_ as O}from"./ClientareaLayout-3c6b83a4.js";import{I as S,c as E}from"./helpers-67f99cdb.js";import{t as g}from"./toast-16cb0d70.js";import{r as V,T as $,o as n,k as C,f as i,d as e,t as l,b as a,c as d,F as T,l as j,u as c,O as I}from"./app-122945be.js";import{_ as q}from"./WeekResume-751cb689.js";import"./IconList-918c48de.js";import"./IconUser-ab1b88a0.js";import"./use-resolve-button-type-8ccbf1fc.js";import"./Modal-fd36b0db.js";const R={class:"title"},B={class:"grid grid-cols-1 lg:grid-cols-2 gap-4 text-gray-600 mb-6"},M={class:"flex items-center justify-between mb-4 text-gray-600"},N=e("span",{class:"title"}," Movimientos ",-1),D={key:0,class:"text-center text-gray-400 mb-4"},F={key:1,class:"grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4"},P={class:"bg-card p-3 rounded-lg"},U={class:"flex items-center justify-between"},A={class:"text-gray-400 text-sm mb-2"},L={class:"px-1 py-1"},z={class:"flex items-center justify-between"},G={class:"text-sm text-gray-600 font-bold"},H={class:"text-xl text-gray-600 font-bold"},J=e("option",{value:"RETIRO"},"RETIRO",-1),K=e("option",{value:"DEPOSITO"},"DEPOSITO",-1),le={__name:"Show",props:{movements:{type:Object,required:!0},seller:{type:Object,required:!0},week:{type:String,required:!0},week_resume:{type:Object,required:!0}},setup(s){const u=s,_=V(!1),o=$({id:null,type:"RETIRO",week:u.week,amount:null});function f(){o.reset(),_.value=!1}function v(){o.post(route("clientarea.sellers.archings.store",u.seller.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{f(),g.success("Movimiento agregado")},onError:m=>{console.log(m)}})}function y(m){E({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{I.delete(route("clientarea.sellers.archings.destroy",[u.seller.id,m]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{g.success("Eliminado correctamente")}})}})}return(m,r)=>(n(),C(O,{title:"Caja"},{header:i(()=>{var t,p;return[e("span",R,l(s.seller.name)+": "+l((p=(t=s.week_resume)==null?void 0:t.data)==null?void 0:p.week_label),1)]}),default:i(()=>[e("div",B,[a(q,{week:s.week_resume.data},null,8,["week"])]),e("div",M,[N,e("button",{onClick:r[0]||(r[0]=t=>_.value=!0),type:"button",class:"primary-button"}," Nuevo ")]),s.movements.data.length==0?(n(),d("div",D," No hay movimientos ")):(n(),d("div",F,[(n(!0),d(T,null,j(s.movements.data,t=>(n(),d("div",P,[e("div",U,[e("div",A,l(t.created_at),1),a(h,null,{default:i(()=>[e("div",L,[a(b,{onClick:p=>y(t.id),title:"Eliminar",icon:c(S)},null,8,["onClick","icon"])])]),_:2},1024)]),e("div",z,[e("span",G,l(t.type),1),e("span",H,l(t.amount),1)])]))),256))])),a(w,{show:_.value,title:"Movimiento",onOnCancel:f,onOnSubmit:v},{default:i(()=>[a(k,{modelValue:c(o).type,"onUpdate:modelValue":r[1]||(r[1]=t=>c(o).type=t),text:"Tipo",required:""},{default:i(()=>[J,K]),_:1},8,["modelValue"]),a(x,{modelValue:c(o).amount,"onUpdate:modelValue":r[2]||(r[2]=t=>c(o).amount=t),type:"number",text:"Cantidad",required:""},null,8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{le as default};
