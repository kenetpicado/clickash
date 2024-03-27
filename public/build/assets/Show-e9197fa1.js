import{_ as b,a as h}from"./DropdownItem-77132e59.js";import{_ as x}from"./InputForm-4bef88d5.js";import{_ as k}from"./SelectForm-de4d3096.js";import{_ as w}from"./FormModal-f587c56e.js";import{_ as O}from"./ClientareaLayout-6ba07821.js";import{c as S}from"./helpers-6533153d.js";import{t as g}from"./toast-b31a6bfb.js";import{r as E,T as V,o as n,k as $,f as i,d as e,t as l,b as a,c as d,F as C,l as T,u as c,O as j}from"./app-0b1a365b.js";import{_ as I}from"./WeekResume-b3f375c2.js";import{I as q}from"./IconTrash-b41e2d54.js";import"./createVueComponent-cad2a883.js";import"./Modal-87d49a6b.js";import"./IconUser-13c14842.js";const R={class:"title"},B={class:"grid grid-cols-1 lg:grid-cols-2 gap-4 text-gray-600 mb-6"},M={class:"flex items-center justify-between mb-4 text-gray-600"},N=e("span",{class:"title"}," Movimientos ",-1),D={key:0,class:"text-center text-gray-400 mb-4"},F={key:1,class:"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4"},P={class:"bg-gray-100 p-3 rounded-lg"},U={class:"flex items-center justify-between"},A={class:"text-gray-400 text-sm mb-2"},L={class:"px-1 py-1"},z={class:"flex items-center justify-between"},G={class:"text-sm text-gray-600 font-bold"},H={class:"text-xl text-gray-600 font-bold"},J=e("option",{value:"RETIRO"},"RETIRO",-1),K=e("option",{value:"DEPOSITO"},"DEPOSITO",-1),le={__name:"Show",props:{movements:{type:Object,required:!0},seller:{type:Object,required:!0},week:{type:String,required:!0},week_resume:{type:Object,required:!0}},setup(s){const u=s,_=E(!1),o=V({id:null,type:"RETIRO",week:u.week,amount:null});function p(){o.reset(),_.value=!1}function v(){o.post(route("clientarea.sellers.archings.store",u.seller.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{p(),g.success("Movimiento agregado")},onError:m=>{console.log(m)}})}function y(m){S({message:"¿Está seguro de eliminar este registro?",onConfirm:()=>{j.delete(route("clientarea.sellers.archings.destroy",[u.seller.id,m]),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{g.success("Eliminado correctamente")}})}})}return(m,r)=>(n(),$(O,{title:"Caja"},{header:i(()=>{var t,f;return[e("span",R,l(s.seller.name)+": "+l((f=(t=s.week_resume)==null?void 0:t.data)==null?void 0:f.week_label),1)]}),default:i(()=>[e("div",B,[a(I,{week:s.week_resume.data},null,8,["week"])]),e("div",M,[N,e("button",{onClick:r[0]||(r[0]=t=>_.value=!0),type:"button",class:"primary-button"}," Nuevo ")]),s.movements.data.length==0?(n(),d("div",D," No hay movimientos ")):(n(),d("div",F,[(n(!0),d(C,null,T(s.movements.data,t=>(n(),d("div",P,[e("div",U,[e("div",A,l(t.created_at),1),a(h,null,{default:i(()=>[e("div",L,[a(b,{onClick:f=>y(t.id),title:"Eliminar",icon:c(q)},null,8,["onClick","icon"])])]),_:2},1024)]),e("div",z,[e("span",G,l(t.type),1),e("span",H,l(t.amount),1)])]))),256))])),a(w,{show:_.value,title:"Movimiento",onOnCancel:p,onOnSubmit:v},{default:i(()=>[a(k,{modelValue:c(o).type,"onUpdate:modelValue":r[1]||(r[1]=t=>c(o).type=t),text:"Tipo",required:""},{default:i(()=>[J,K]),_:1},8,["modelValue"]),a(x,{modelValue:c(o).amount,"onUpdate:modelValue":r[2]||(r[2]=t=>c(o).amount=t),type:"number",text:"Cantidad",required:""},null,8,["modelValue"])]),_:1},8,["show"])]),_:1}))}};export{le as default};