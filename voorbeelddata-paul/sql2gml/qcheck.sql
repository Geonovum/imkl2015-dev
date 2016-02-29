\echo all

select gid,thema,netbeheer
from aanduidingEisVoorzorgsmaatregel l where
    (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Annotatie_lijn                                                        l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Annotatie                                                             l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  BGevaarlijkeInhoud                                                    l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Containerelement                                                      l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Diepte                                                                l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  ExtraDetailInfo                                                       l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  ExtraGeometrie                                                        l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  ExtraTopo                                                             l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  KabelEnLeidingContainer                                               l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Kunstwerk_Containerelement                                            l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Leidingelement                                                        l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  maatvoering_label                                                     l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  maatvoering_lijn                                                      l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  maatvoering_pijl                                                      l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  RioolVV_KabelOfLeiding                                                l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  Water_KabelOfLeiding                                                  l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  elektriciteitskabel                                                   l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
select gid,thema,netbeheer from  oliegaschemicalien                                                    l where (select bhcode from utiliteitsnet u where u.thema = l.thema and l.netbeheer = u.authority) is null;
