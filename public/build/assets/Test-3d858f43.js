import{r as p,o as a,c as u,b as r,d as e,f as _,F as b,l as g,C as n,N as d,D as f,u as x,P as h,t as v}from"./app-3eeff63f.js";import{_ as y}from"./InputForm-78d66890.js";import{I as V}from"./IconTrash-676581aa.js";import"./createVueComponent-06cc832b.js";const k={class:"h-full w-full p-4"},w=e("hr",{class:"mt-4 mb-4"},null,-1),C={class:"grid grid-cols-1 gap-4"},U={class:"grid grid-cols-2 gap-4 items-end"},T=e("label",{class:"block font-medium text-sm text-basic mb-1"}," Digito ",-1),D=["onUpdate:modelValue"],$=e("label",{class:"block font-medium text-sm text-basic mb-1"}," Monto ",-1),B=["onUpdate:modelValue"],M=e("label",{class:"block font-medium text-sm text-basic mb-1"}," Turno ",-1),N=["onUpdate:modelValue"],E=e("label",{class:"block font-medium text-sm text-basic mb-1"}," Super X ",-1),F=["onUpdate:modelValue"],G=["onClick"],I={class:"bg-green-pea-50 mb-3 p-4 rounded-xl text-lg font-bold text-center text-gray-500"},S=e("button",{type:"button",class:"primary-button w-full"}," Guardar ",-1),j={__name:"Test",setup(A){const i=p("Jairo"),l=p([{digit:null,amount:null,super_x:!1}]);function m(){l.value.push({digit:null,amount:null,super_x:!1})}return(J,c)=>(a(),u("div",k,[r(y,{modelValue:i.value,"onUpdate:modelValue":c[0]||(c[0]=t=>i.value=t),text:"Cliente (Opcional)"},null,8,["modelValue"]),w,e("div",C,[r(h,{name:"list",tag:"div"},{default:_(()=>[(a(!0),u(b,null,g(l.value,(t,s)=>(a(),u("div",{key:s,class:"bg-green-pea-50 rounded-xl px-3 pt-3 mb-3"},[e("div",U,[e("div",null,[T,n(e("input",{class:"border-gray-300 focus:border-green-pea-500 focus:ring-green-pea-500 rounded-lg w-full transition duration-300 ease-in-out","onUpdate:modelValue":o=>t.digit=o,type:"number"},null,8,D),[[d,t.digit]])]),e("div",null,[$,n(e("input",{placeholder:"C$ 0",class:"border-gray-300 focus:border-green-pea-500 focus:ring-green-pea-500 rounded-lg w-full transition duration-300 ease-in-out","onUpdate:modelValue":o=>t.amount=o,type:"number"},null,8,B),[[d,t.amount]])]),e("div",null,[M,n(e("input",{class:"border-gray-300 focus:border-green-pea-500 focus:ring-green-pea-500 rounded-lg w-full transition duration-300 ease-in-out","onUpdate:modelValue":o=>t.turn=o,type:"text"},null,8,N),[[d,t.turn]])]),e("div",null,[E,n(e("input",{"onUpdate:modelValue":o=>t.super_x=o,type:"checkbox",class:"w-5 h-5 text-green-pea-500 bg-white border-gray-300 rounded focus:ring-green-pea-500 focus:ring-2 mb-2"},null,8,F),[[f,t.super_x]])])]),e("button",{type:"button",class:"text-red-500 w-full mt-2",onClick:o=>l.value.splice(s,1)},[r(x(V),{class:"text-green-pea-300 ml-auto"})],8,G)]))),128))]),_:1})]),e("button",{type:"button",class:"secondary-button w-full mb-5",onClick:m}," Agregar digito "),e("div",I," Total: C$"+v(l.value.reduce((t,s)=>t+s.amount,0)),1),S]))}};export{j as default};
