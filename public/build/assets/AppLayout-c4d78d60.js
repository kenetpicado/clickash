import{o as t,c as a,b as e,a as n,e as u,u as o,i as h,F as f,k,t as p,j as _,n as m,A as C,O as I,Z as $,d as x,p as y}from"./app-1d5307ec.js";import{I as b}from"./IconUsers-2302404f.js";import{c as v,I as A,a as S}from"./IconUser-a321f0bf.js";var L=v("chevron-right","IconChevronRight",[["path",{d:"M9 6l6 6l-6 6",key:"svg-0"}]]),B=v("logout","IconLogout",[["path",{d:"M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2",key:"svg-0"}],["path",{d:"M9 12h12l-3 -3",key:"svg-1"}],["path",{d:"M18 15l3 -3",key:"svg-2"}]]);const M={class:"w-72 p-3 flex flex-col hidden lg:block min-h-screen bg-white border m-0"},N={class:"flex flex-col items-center my-6"},U=e("h2",{class:"font-bold text-gray-600 text-xl"}," ClickAsh ",-1),V={class:"space-y-2"},D={key:0,class:"block text-xs text-gray-400 uppercase tracking-wider mt-6 px-2"},F=e("span",null,"Salir",-1),O={__name:"Sidebar",setup(l){const c=b,g=()=>{I.post(route("logout"))},i=[{header:"Administración"},{name:"Usuarios",route:route("dashboard.users.index"),icon:b},{name:"Rifas",route:route("dashboard.raffles.index"),icon:A},{header:"Sistema"},{name:"Perfil",route:route("profile.index"),icon:S}];function d(r){return window.location.href.includes(r)?"bg-primary text-white":"hover:bg-gray-100"}function w(r){return window.location.href.includes(r)?"text-white":""}return(r,Z)=>(t(),a("aside",M,[e("div",N,[n(o(h),{href:r.route("dashboard.index")},{default:u(()=>[U]),_:1},8,["href"])]),e("ul",V,[(t(),a(f,null,k(i,s=>e("li",null,[s.header?(t(),a("span",D,p(s.header),1)):(t(),_(o(h),{key:1,href:s.route},{default:u(()=>[e("span",{class:m(["flex items-center px-2 py-3 rounded-xl gap-4",d(s.route)])},[(t(),_(C(s.icon??o(c)),{class:m(w(s.route))},null,8,["class"])),e("span",null,p(s.name),1)],2)]),_:2},1032,["href"]))])),64)),e("li",null,[e("span",{onClick:g,class:"flex items-center px-2 py-3 rounded-xl gap-4 hover:bg-gray-100",role:"button"},[n(o(B)),F])])])]))}},R={class:"flex w-full bg-gray-100"},j={class:"w-full p-4 lg:p-8"},E={key:0,class:"flex items-center mb-4"},z={class:"flex items-center"},G={class:"text-sm me-2 tracking-wider text-gray-500"},P={class:"w-full"},T={class:"flex items-center justify-between h-10 mb-6"},K={__name:"AppLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(l){return(c,g)=>(t(),a(f,null,[n(o($),{title:l.title},null,8,["title"]),e("section",R,[n(O),e("main",j,[l.breads.length>0?(t(),a("ol",E,[(t(!0),a(f,null,k(l.breads,(i,d)=>(t(),a("li",z,[d!=0?(t(),_(o(L),{key:0,class:"text-gray-300"})):x("",!0),n(o(h),{href:i.route},{default:u(()=>[e("span",G,p(i.name),1)]),_:2},1032,["href"])]))),256))])):x("",!0),e("div",P,[e("div",T,[y(c.$slots,"header")]),y(c.$slots,"default")])])])],64))}};export{K as _};