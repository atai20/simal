uses graphABC, ABCobjects;
const 
kp=10;
var
u,k,iu,ko,ok:integer;
tex:array [1..80] of string:=('s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s','s');
do1:=130;
re:=146;
mi:=164;
pha:=174;
sol:=196;
la:=220;
si:=246;


do2:=261;
re2:=293;
mi2:=329;
pha2:=349;
sol2:=392;
la2:=440;
si2:=493;


do3:=523;
re3:=587;
mi3:=659;
pha3:=698;
sol3:=783;
la3:=880;
si3:=987;


begin
ko:=200;
while u<1 do begin

var

h:array [1..4] of integer:=(pha2,do3,re3,mi3);

if k<4 then begin
k:=k+1;


 
 system.Console.beep(h[k],ko);
end;
if k=4 then begin
iu:=iu+1;
k:=0;
if iu=2 then begin
pha2:=sol2;
end;
if iu=3 then begin
 pha2:=la2;
end;
if iu=6 then begin
 pha2:=si2;
end;
if iu=7 then begin
 pha2:=sol2;
end;

if iu=10 then begin
 pha2:=la2;;
 
end;
if iu=11 then begin
 pha2:=sol2;;
 
end;
if iu=14 then begin
 pha2:=349;
 
end;
if iu=14 then begin
 pha2:=sol2;
 
end;
if iu>15 then begin
 ko:=ko+40;

end;
if iu>20 then begin
 u:=1;

end;
end;
 end;

end.