import{T as p,r as f,o as i,c as l,a,u as t,Z as g,b as s,t as _,d as x,w as h,e as b,f as w,i as y,F as V}from"./app-be0400f8.js";import{_ as k}from"./Checkbox-bbe27916.js";import{_ as d}from"./InputForm-d9bf4b6c.js";const v={class:"min-h-screen flex flex-col sm:justify-center items-center pt-3 sm:pt-0 bg-white px-4 lg:px-0"},C=s("img",{class:"mx-auto h-16 w-auto",src:"/logo1x1.png",alt:"Workflow"},null,-1),S={class:"w-full sm:max-w-md mt-6 px-6 py-8 bg-card shadow-md overflow-hidden rounded-xl"},N=s("h2",{class:"mt-4 text-center text-lg font-extrabold text-basic"}," Inicia sesión ",-1),B={key:0,class:"mb-4 font-medium text-sm text-green-600"},F=["onSubmit"],U=s("button",{type:"submit",class:"w-full primary-button"}," Entrar ",-1),q=s("a",{href:"https://play.google.com/store/apps/details?id=com.strainteam.clickashadmin",target:"_blank"},[s("img",{src:"/images/gp.svg",alt:"",style:{width:"15rem"}})],-1),$={__name:"Login",props:{status:String,app_name:String},setup(m){const e=p({email:"",password:"",remember:!1}),c=()=>{e.transform(n=>({...n,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(n,o)=>{const u=f("loading");return i(),l(V,null,[a(t(g),{title:"Inicia sesión"}),a(u,{active:t(e).processing,"is-full-page":!0},null,8,["active"]),s("div",v,[C,s("div",S,[N,m.status?(i(),l("div",B,_(m.status),1)):x("",!0),s("form",{onSubmit:h(c,["prevent"]),class:"mb-6"},[a(d,{text:"Correo",name:"email",modelValue:t(e).email,"onUpdate:modelValue":o[0]||(o[0]=r=>t(e).email=r),type:"email",required:"",autofocus:""},null,8,["modelValue"]),a(d,{text:"Contraseña",name:"password",modelValue:t(e).password,"onUpdate:modelValue":o[1]||(o[1]=r=>t(e).password=r),type:"password",required:""},null,8,["modelValue"]),a(k,{checked:t(e).remember,"onUpdate:checked":o[2]||(o[2]=r=>t(e).remember=r),text:"Recordarme"},null,8,["checked"]),U],40,F),a(t(y),{href:n.route("register.create"),class:"text-primary font-medium"},{default:b(()=>[w(" Crear cuenta ")]),_:1},8,["href"])]),q])],64)}}};export{$ as default};
