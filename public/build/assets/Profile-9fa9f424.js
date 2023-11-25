import{_ as f}from"./AppLayout-88627344.js";import{o as d,c as _,b as n,p as b,w as y,T as g,e as V,f as l,a as i,u as r,O as S}from"./app-fc7d5a4b.js";import{_ as m}from"./InputForm-b1dd54da.js";import{t as h}from"./toast-59b580ce.js";import"./createVueComponent-3215f9e0.js";import"./IconChevronRight-e06cb0eb.js";import"./_plugin-vue_export-helper-c27b6911.js";const v={class:"bg-white text-gray-600 rounded-lg"},w={class:"grid grid-cols-2 gap-4 p-8"},x={class:"flex items-center justify-end px-4 py-3 bg-gray-50 text-right rounded-b-lg gap-4"},$=n("button",{type:"submit",class:"primary-button"}," Guardar ",-1),C={__name:"FormSection",props:{title:{type:String,default:"Form"}},setup(u){return(t,o)=>(d(),_("div",v,[n("form",{onSubmit:o[1]||(o[1]=y(e=>t.$emit("onSubmit"),["prevent"]))},[n("div",w,[b(t.$slots,"default")]),n("div",x,[n("button",{class:"secondary-button",type:"button",onClick:o[0]||(o[0]=e=>t.$emit("onCancel"))}," Cancelar "),$])],32)]))}},O=n("span",{class:"title mt-1"}," Perfil ",-1),F={__name:"Profile",props:{auth:{type:Object,required:!0}},setup(u){const t=u,o=[{name:"Inicio",route:route("home")},{name:"Perfil",route:route("profile.index")}],e=g({id:t.auth.id,name:t.auth.name,email:t.auth.email,company_name:t.auth.company_name,password:"",password_confirmation:""});function p(){e.password===""&&(delete e.password,delete e.password_confirmation),e.put(route("profile.update",e.id),{preserveScroll:!0,preserveState:!0,onSuccess:()=>{h.success("Profile updated successfully")}})}function c(){S.visit(route("home"))}return(P,a)=>(d(),V(f,{title:"Perfil",breads:o},{header:l(()=>[O]),default:l(()=>[i(C,{title:"Create",onOnSubmit:p,onOnCancel:c},{default:l(()=>[i(m,{text:"Name",modelValue:r(e).name,"onUpdate:modelValue":a[0]||(a[0]=s=>r(e).name=s),required:""},null,8,["modelValue"]),i(m,{text:"Email",modelValue:r(e).email,"onUpdate:modelValue":a[1]||(a[1]=s=>r(e).email=s),type:"email",required:""},null,8,["modelValue"]),i(m,{text:"Company",modelValue:r(e).company_name,"onUpdate:modelValue":a[2]||(a[2]=s=>r(e).company_name=s),required:""},null,8,["modelValue"])]),_:1})]),_:1}))}};export{F as default};