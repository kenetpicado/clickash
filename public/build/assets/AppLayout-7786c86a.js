import{o as s,c as a,b as e,a as o,g as h,t as u,u as t,i as p,F as g,f as b,k as m,n as v,D as w,O as C,Z as I,d as y,C as x}from"./app-0f5d0684.js";import{I as k}from"./IconUsers-73c793db.js";import{c as f}from"./createVueComponent-32bd6799.js";var $=f("chevron-right","IconChevronRight",[["path",{d:"M9 6l6 6l-6 6",key:"svg-0"}]]),M=f("gift","IconGift",[["path",{d:"M3 8m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z",key:"svg-0"}],["path",{d:"M12 8l0 13",key:"svg-1"}],["path",{d:"M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7",key:"svg-2"}],["path",{d:"M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5",key:"svg-3"}]]),S=f("logout","IconLogout",[["path",{d:"M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2",key:"svg-0"}],["path",{d:"M9 12h12l-3 -3",key:"svg-1"}],["path",{d:"M18 15l3 -3",key:"svg-2"}]]),L=f("user","IconUser",[["path",{d:"M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0",key:"svg-0"}],["path",{d:"M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2",key:"svg-1"}]]);const U={class:"w-72 p-3 bg-card flex flex-col hidden lg:block min-h-screen"},A={class:"flex flex-col items-center my-1"},B=e("div",{class:"h-24 w-24"},[e("img",{class:"h-full w-full",src:"/logo-simple.png",alt:""})],-1),D={class:"text-2xl font-extrabold text-basic mb-8"},N={class:"space-y-2 text-basic"},V={key:0,class:"block text-xs text-gray-400 uppercase tracking-wider mt-2 px-2"},F=e("span",null,"Perfil",-1),O=e("span",null,"Salir",-1),R={__name:"Sidebar",setup(n){const c=k,_=()=>{C.post(route("logout"))},i=[{header:"Administración"},{name:"Usuarios",route:route("dashboard.users.index"),icon:k},{name:"Rifas",route:route("dashboard.raffles.index"),icon:M},{header:"Sistema"}];function d(r){return window.location.href==r?"bg-primary":"hover:bg-gray-100"}return(r,q)=>(s(),a("aside",U,[e("div",A,[o(t(p),{href:r.route("home")},{default:h(()=>[B,e("h2",D,u(r.$page.props.app_name),1)]),_:1},8,["href"])]),e("ul",N,[(s(),a(g,null,b(i,l=>e("li",null,[l.header?(s(),a("span",V,u(l.header),1)):(s(),m(t(p),{key:1,href:l.route},{default:h(()=>[e("span",{class:v(["flex items-center px-2 py-3 rounded-lg gap-4",d(l.route)])},[(s(),m(w(l.icon??t(c)))),e("span",null,u(l.name),1)],2)]),_:2},1032,["href"]))])),64)),e("li",null,[o(t(p),{href:r.route("profile.index")},{default:h(()=>[e("span",{class:v(["flex items-center px-2 py-3 rounded-lg gap-4",d(r.route("profile.index"))])},[o(t(L)),F],2)]),_:1},8,["href"])]),e("li",null,[e("span",{onClick:_,class:"flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-gray-100",role:"button"},[o(t(S)),O])])])]))}},z={class:"flex w-full"},E={class:"w-full p-4 lg:p-8"},G={key:0,class:"flex items-center mb-4"},j={class:"flex items-center"},P={class:"text-sm me-2 tracking-wider text-basic"},T={class:"w-full"},Z={class:"flex items-center justify-between h-10 mb-6 text-basic"},Q={__name:"AppLayout",props:{title:{type:String,default:""},breads:{type:Array,default:[]}},setup(n){return(c,_)=>(s(),a(g,null,[o(t(I),{title:n.title},null,8,["title"]),e("section",z,[o(R),e("main",E,[n.breads.length>0?(s(),a("ol",G,[(s(!0),a(g,null,b(n.breads,(i,d)=>(s(),a("li",j,[d!=0?(s(),m(t($),{key:0,class:"text-gray-300"})):y("",!0),o(t(p),{href:i.route},{default:h(()=>[e("span",P,u(i.name),1)]),_:2},1032,["href"])]))),256))])):y("",!0),e("div",T,[e("div",Z,[x(c.$slots,"header")]),x(c.$slots,"default")])])])],64))}};export{Q as _};
