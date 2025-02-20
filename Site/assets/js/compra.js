// Função para obter o ID do livro da URL
function getBookIdFromUrl() {
    const params = new URLSearchParams(window.location.search);
    return params.get('id');
}

// Função para buscar e exibir os dados do livro
function loadBookDetails() {
    const bookId = getBookIdFromUrl();
    
    // Dados simulados dos livros
    const books = [
        { id: '1', 
        title: 'Um amor cinco estrelas',
        author: 'Beth O’Leary', price: 'R$43,00', 
        description: 'A Mansão Forest Hotel & Spa está literalmente caindo aos pedaços. Depois de anos lidando com dificuldades financeiras, o lugar parece enfim prestes a fechar as portas de vez, a não ser que um verdadeiro milagre de Natal aconteça antes da virada do ano. Então, quando Izzy e Lucas são obrigados a trabalhar juntos na recepção por conta de cortes de custos, eles não têm escolha a não ser deixar suas diferenças de lado (não importa o quanto se desprezem) na tentativa de fazer o hotel sobreviver.', 
        OriginalPrice:'R$50,40',  
        Assessment:'★★★★☆', 
        book0:'https://m.media-amazon.com/images/I/71xh-XoYyaL._SL1500_.jpg', 
        book1:'https://m.media-amazon.com/images/I/51dX25QxS8L._SL1005_.jpg',
        book2:'https://m.media-amazon.com/images/I/51v7TlyXpeL._SY425_.jpg',
        book3:'https://m.media-amazon.com/images/I/514ByDXbo+L._SL1300_.jpg',
        genero: 'Romance',
        genero2: 'Ficção',

    },

        { id: '2', 
        title: 'Orgulho e Preconceito', 
        author: 'Jane Austen', price: 'R$39,00',
        description: 'A Mansão Forest Hotel & Spa está literalmente caindo aos pedaços. Depois de anos lidando com dificuldades financeiras, o lugar parece enfim prestes a fechar as portas de vez, a não ser que um verdadeiro milagre de Natal aconteça antes da virada do ano. Então, quando Izzy e Lucas são obrigados a trabalhar juntos na recepção por conta de cortes de custos, eles não têm escolha a não ser deixar suas diferenças de lado (não importa o quanto se desprezem) na tentativa de fazer o hotel sobreviver..' , OriginalPrice:'R$50,40',  Assessment:'★★★★☆', book0:'https://m.media-amazon.com/images/I/51lC3sHYyML._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/71e4ecRRs4L._SL1297_.jpg', book2:'https://m.media-amazon.com/images/I/51RQsktA1qL.jpg',
        genero: 'Romance',
        genero2: 'Clássico',
}, 

        { id: '3', title: 'É Assim que Acaba', author: 'Colleen Hoover ', price: 'R$36,02', description: 'Em É assim que acaba , Colleen Hoover nos apresenta Lily, uma jovem que se mudou de uma cidadezinha do Maine para Boston, se formou em marketing e abriu a própria floricultura. E é em um dos terraços de Boston que ela conhece Ryle, um neurocirurgião confiante, teimoso e talvez até um pouco arrogante, com uma grande aversão a relacionamentos, mas que se sente muito atraído por ela.' , OriginalPrice:'R$59,90',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/51i7kH+rh9L._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/91NiKTnC8mL._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/81WMMjANghL._SL1500_.jpg',
            genero: 'Romance',
            genero2: 'Drama',
        }, 

        { id: '4', title: 'Gokurakugai', author: ' Sano Yuuto ', price: 'R$35,90', description: 'Gokurakugai, também conhecido como "Distrito do Paraíso", é um bairro no centro da cidade onde o esplendor, a agitação e uma profunda escuridão se misturam. Neste local caótico, Tao e Alma levam a vida como "solucionadores de problemas". Diante dos dois, surge um garoto em busca de seu amigo, um homem-fera, desaparecido. Indivíduos seguem desaparecendo incessantemente, animais são mortos de forma violenta… Quando a escuridão do macabro crepúsculo cobre a cidade, a outra face dos "solucionadores" aparece!!Começa agora a ação em grande escala para exterminar os seres disformes que atacam e devoram pessoas!!' , OriginalPrice:'R$39,90',  Assessment:'★★★★☆', book0:'https://m.media-amazon.com/images/I/61CFV6diVeL._SY445_SX342_.jpg',
            genero: 'Mangá',
            genero2: 'Aventura',
        }, 

        { id: '5', title: 'Crazy Food Truck', author: '  Rokurou Ogaki  ', price: 'R$69,90', description: 'Gordon é um cozinheiro de meia-idade e pouca conversa que percorre o deserto ao volante de seu food truck. Sua rotina é virada de cabeça para baixo quando encontra Alisa, uma jovem que dormia no meio da estrada... totalmente nua! ' , OriginalPrice:'R$89,90',  Assessment:'★★★★☆', book0:'https://m.media-amazon.com/images/I/51UeuDARMsL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/91HkWEhjWlL._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/81BlqmCw+VL._SL1500_.jpg',
            genero: 'Mangá',
            genero2: 'Comédia',
        }, 

        { id: '6', title: 'Mulheres sem nome', author: '  Martha Hall Kelly,  ', price: 'R$14,07', description: 'A socialite nova-iorquina Caroline Ferriday está sobrecarregada de trabalho no Consulado da França, em função da iminência da guerra. O ano é 1939 e o Exército de Hitler acaba de invadir a Polônia, onde Kasia Kuzmerick vai deixando para trás a tranquilidade da infância conforme se envolve cada vez mais com o movimento de resistência de seu país. Distante das duas, a ambiciosa Herta Oberheuser tem a oportunidade de se libertar de uma vida desoladora e abraçar o sonho de se tornar médica cirurgiã, a serviço da Alemanha.' , OriginalPrice:'R$46,90',  Assessment:'★★★★☆', book0:'https://m.media-amazon.com/images/I/518Ekt4hFtL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/81nzNfR3x2L._SL1500_.jpg',
            genero: 'Não-ficção',
            genero2: 'História',
        }, 

        { id: '7', title: 'A abolição', author: ' Emilia Viotti da Costa', price: 'R$36,58', description: 'Este livro, escrito por uma das maiores historiadoras brasileiras, além de apresentar com maestria uma poderosa síntese do processo da abolição da escravidão, fornece informações precisas e análises cuidadosas que honram o compromisso do historiador de redigir uma história acessível e de alto nível.' , OriginalPrice:'R$54,00',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/51jXUroAsAL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/91yFjcFOq6L._SY425_.jpg',
        genero: 'História',
        genero2: 'Não-ficção',

        }, 

        { id: '8', title: 'Este É O Mar', author: ' Mariana Enriquez', price: 'R$40,00', description: 'Lendas do rock nunca fenecem. E tudo porque entregaram a vida às Luminosas, seres atemporais que se alimentam dos aspectos mais pungentes da devoção humana. Kurt Cobain? Lenda criada por Violeta. Sid Vicious? Gina. Jim Morrison? Marianne. No universo de Este é o mar , se tornar uma verdadeira lenda do rock envolve seres mitológicos femininos e um mundo intenso e sombrio, marcado pelo esquecimento e pelas lembranças que atravessam gerações.' , OriginalPrice:'R$54,00',  Assessment:'★★★★☆', book0:'https://m.media-amazon.com/images/I/81ipM1rerRL._SY425_.jpg', book1:'https://m.media-amazon.com/images/I/71YHGuL0f6L._SY425_.jpg', book2:'https://m.media-amazon.com/images/I/417W7VF0yvL.jpg',
            genero: 'Ficção',
            genero2: 'Contos',
        }, 

        { id: '9', title: 'O legado de Lutero', author: '  R. C. Sproul', price: 'R$70,00', description: 'Martinho Lutero foi o homem mais influente de sua época. O movimento que teve início com a publicação de suas 95 teses redefiniu a Europa, redirecionou a história da fé cristã e restabeleceu a verdade das Escrituras no centro da vida eclesiástica. Quinhentos anos depois, qual é o seu grande legado para a igreja cristã' , OriginalPrice:'R$84,00',  Assessment:'★★★★☆', book0:'https://m.media-amazon.com/images/I/51-1ppW+V0L._SY445_SX342_.jpg',
            genero: 'História',
            genero2: 'Teologia',
        }, 

        { id: '10', title: 'O Homem-Cão: Imundície e castigo', author: '  Dav Pilkey ', price: 'R$35.00', description: 'Parece que a carreira do Homem-Cão na polícia chegou ao fim. Depois de comer a preciosa plantação de rosas do prefeito da cidade, ele não conseguiu evitar a demissão e teve que entregar seu distintivo de uma vez por todas.  Mas, apesar de ter perdido seu emprego, ele ainda não perdeu as esperanças! Afinal, proteger a cidade e fazer o bem são as maiores metas desse herói coraujoso.' , OriginalPrice:'R$45.00',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/51oqtsPW3hL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/81uumQP4t3L._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/81B-egirIbL._SL1500_.jpg',
            genero: 'Infantil',
            genero2: 'Quadrinhos',
        }, 

        { id: '11', title: 'O idiota', author: '  Fiódor Dostoiévski ', price: 'R$56,19', description: 'O idiota é uma das obras mais comoventes de Fiódor Dostoiévski. Abstrusa para os contemporâneos do escritor, mas atual e compreensível para quem a conhecer em nossos dias, ela conta a história de um jovem aristocrata russo que se atreve a defender o sublime ideal humanista numa sociedade regida pelas leis do livre comércio. Ovelha negra da alta-roda de São Petersburgo, o príncipe Míchkin é tachado de idiota em virtude das suas qualidades morais e acaba perdendo de fato o juízo. Sua imagem de mártir e visionário, inspirada na do magnífico Dom Quixote de Cervantes, fica interiorizada pelo leitor; seu trágico fim leva-o a perguntar a si mesmo onde termina a loucura e começa a santidade do protagonista e, consequentemente, a repensar o próprio conceito daquilo que pode ser objeto de compra e venda no conturbado âmbito das relações humanas. ' , OriginalPrice:'R$89,00',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/31mjUV-3MVS._SY445_SX342_.jpg',
            genero: 'Romance',
            genero2: 'Clássico',
        }, 

        { id: '12', title: 'O diário de Anne Frank', author: '   Anne Frank ', price: 'R$15,00', description: 'O Diário de Anne Frank teve a autenticidade confirmada por peritos. Estudos forenses da caligrafia de Anne e exame do papel do diário, da tinta e da cola comprovaram ser de material existente na época. A conclusão foi oficialmente apresentada pelo Instituto Estatal Holandês para Documentação da Guerra.' , OriginalPrice:'R$29,90',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/41+PZUZS7LL._SY445_SX342_.jpg',book1:'https://m.media-amazon.com/images/I/61cJeBhAO7L._SY425_.jpg',
            genero: 'Biografia',
            genero2: 'História',
        },

        { id: '13', title: 'Demon Slayer: Academia', author: '   Koyoharu Gotouge ', price: 'R$35,90', description: 'Sejam bem-vindos a Academia Demon, uma instituição privada de ensino com turmas do ginasial e colegial!!Aqui nós vamos ver os personagens do sucesso "Demon Slayer" como alunos e professores e é claro que a vida escolar de Tanjirou e seus amigos vai ser comédia pura!!Começa agora um spin-off oficial de "Demon Slayer"!!' , OriginalPrice:'R$39,90',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/61Io09gb90L._SY425_.jpg',
            genero: 'Mangá',
            genero2: 'Aventura',
        },

        { id: '14', title: 'Sonic The Hedgehog: Cidade em crise', author: '   Ian Flynn ', price: 'R$47,49', description: 'PODERÁ SONIC SALVAR UMA CIDADE EM CRISE... OU ELE FINALMENTE ENCONTROU UM RIVAL À ALTURA? Dr. Eggman executou seu plano mais radical e Sonic está na corrida para detê-lo! Enquanto Dr. Eggman submerge cidades inteiras no seu vírus metálico, criando bandos de zombôs – os civis infectados com o vírus para virarem máquinas manipuladas – o próprio Sonic luta para manter sua infecção sob controle! E quando os amigos de Sonic começam a virar as vítimas, a situação fica clara: Ninguém está salvo!' , OriginalPrice:'R$59,90',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/91RcGOBaU3L._SY425_.jpg', book1:'https://m.media-amazon.com/images/I/81cKvb-na+L._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/71TDZjqB-JL._SL1500_.jpg',
            genero: 'Quadrinhos',
            genero2: 'Aventura',
        },

        { id: '15', title: 'Blue Lock Vol. 23', author: 'Yusuke Nomura ', price: 'R$35,90', description: 'Se não os encararmos aqui, não teremos uma próxima chance! Confronto extremo, o clímax do egoísmo!!Terceira rodada da Liga Neo Egoísta, Alemanha vs. Inglaterra! Depois de prever a oportunidade decisiva do Chris, Isagi usa sua habilidade de previsão para contra-atacar! No entanto, é o Yukimiya, que carrega um "destino" que não o deixa perder, que assume o papel de protagonista! Em meio ao conflito entre “razão” e “ideal”, qual é a nova “peça” que Isagi encontrará para derrota do Kaiser? Testemunhe o extraordinário despertar que ninguém esperava! E veja quem será o último herói a dominar este frenesi!!A partida contra Manshine City termina! A revolução que inaugura uma nova era do futebol chegou!!' , OriginalPrice:'R$39,90',  Assessment:'★★★★★', book0:'https://m.media-amazon.com/images/I/61Ds6t9A2TL._SY425_.jpg',
            genero: 'Mangá',
            genero2: 'Esportes',
        },

        { id: '16', 
        title: 'One Piece Vol. 1', 
        author: 'Eiichiro Oda ', 
        price: ' R$27,63', 
        description: 'A tripulação pirata mais famosa dos quadrinhos finalmente joga sua âncora de novo no Brasil! Com roteiro e arte de Eiichiro Oda, o mangá de maior sucesso de todos os tempos retorna ao país, agora sob a bandeira Planet Mangá, da Panini Comics! Para ser o rei dos piratas, Luffy, o homem-borracha, precisa reunir uma tripulação e encontrar o maior de todos os tesouros. No caminho, enfrentará a Marinha, monstros, e muitos outros piratas que têm o mesmo objetivo. Então prepare-se pra encarar os perigos dos mares. A maior aventura de todas vai recomeçar!',
        OriginalPrice:'R$34,90',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/51zPKHupwGL._SY445_SX342_.jpg',
       genero: 'Mangá',
       genero2: 'Aventura',},

        { id: '17', 
        title: 'O mágico de Oz ', 
        author: 'L. Frank Baum ', 
        price: ' R$50,12', 
        description: 'Ao imaginar um conto de fadas para o mundo moderno, O mágico de Oz revoluciona as histórias para crianças. Um mundo de cores, magia e aventura espera pela garotinha Dorothy, que chega em Oz por acidente quando um grande furacão carrega sua casa até essa terra longínqua. Os habitantes deste lugar tão especial logo recebem a menina como uma heroína capaz de combater bruxas malvadas, mas tudo o que Dorothy mais deseja é voltar à sua terra para reencontrar os tios. Na esperança de conseguir retornar para casa, ela parte em uma aventura para pedir ajuda ao Grande Mágico de Oz, e, no caminho, novos amigos se juntam a Dorothy: o Espantalho, que tem esperança de que Oz lhe dê um cérebro, o Homem de Lata, que deseja um coração, e o Leão Covarde, que sonha em ser corajoso. ',
        OriginalPrice:'R$89,90',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/518xcvEcOFL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/81fm0hvY9gL._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/71vZxSnBYOL._SL1500_.jpg',
       genero: 'Ficção',
       genero2: 'Fantasia',
      
    },
       
       

        { id: '18', 
        title: 'Dom Casmurro', 
        author: 'Machado de Assis ', 
        price: ' R$17,68', 
        description: 'Em Dom Casmurro, o narrador Bento Santiago retoma a infância que passou na Rua de Matacavalos e conta a história do amor e das desventuras que viveu com Capitu, uma das personagens mais enigmáticas e intrigantes da literatura brasileira. Nas páginas deste romance, encontra-se a versão de um homem perturbado pelo ciúme, que revela aos poucos sua psicologia complexa e enreda o leitor em sua narrativa ambígua acerca do acontecimento ou não do adultério da mulher com olhos de ressaca, uma das maiores polêmicas da literatura brasileira.',
        OriginalPrice:'R$24,90',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/61Z2bMhGicL._SY425_.jpg', book1:'https://m.media-amazon.com/images/I/719wq2zUDtL._SY425_.jpg', book2:'https://m.media-amazon.com/images/I/71l345SEg9L._SX679_.jpg',
       genero: 'Romance',
       genero2: 'Clássico',
    },

        { id: '19', 
        title: 'O Alienista', 
        author: 'Machado de Assis ', 
        price: 'R$14,13', 
        description: 'Machado de Assis, neste livro, propõe a seguinte pergunta: quem é louco? Conheça a história do médico Simão Bacamarte, dedicado e estudioso da mente humana, que decide construir um hospício para tratar os doentes mentais na pequena cidade de Itaguaí a casa verde. Quem entra e quem fica de fora?',
        OriginalPrice:'R$19,90',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/41ls0DpJwOL._SY445_SX342_.jpg',book1:'https://m.media-amazon.com/images/I/61s5PWi2S4L._SY425_.jpg',
       genero: 'Ficção',
       genero2: 'Clássico',
    },

        { id: '20', 
        title: 'O Hobbit', 
        author: 'J.R.R. Tolkien ', 
        price: ' R$43,76', 
        description: 'Lançado em 1937, O Hobbit é um divisor de águas na literatura de fantasia mundial. Mais de 80 anos após a sua publicação, o livro que antecede os ocorridos em O Senhor dos Anéis continua arrebatando fãs de todas as idades, talvez pelo seu tom brincalhão com uma pitada de magia élfica, ou talvez porque J.R.R. Tolkien tenha escrito o melhor livro infantojuvenil de todos os tempos.',
        OriginalPrice:'R$69,90 ',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/511+-lOOtsL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/91huSRrEHNL._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/81Eys9h4yRL._SL1500_.jpg',
       genero: 'Fantasia',
       genero2: 'Aventura',},

        { id: '21', 
        title: 'It: A coisa', 
        author: 'Stephen King', 
        price: ' R$78,99', 
        description: 'Durante as férias de 1958, em uma pacata cidadezinha chamada Derry, um grupo de sete amigos começa a ver coisas estranhas. Um conta que viu um palhaço, outro que viu uma múmia. Finalmente, acabam descobrindo que estavam todos vendo a mesma coisa: um ser sobrenatural e maligno que pode assumir várias formas. É assim que Bill, Beverly, Eddie, Ben, Richie, Mike e Stan enfrentam a Coisa pela primeira vez.',
        OriginalPrice:'R$139,90 ',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/51z0s3GcvwL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/81+b57GqAWL._SY425_.jpg', book2:'https://m.media-amazon.com/images/I/71IYhitXqUL._SY425_.jpg',
       genero: 'Terror',
       genero2: 'Ficção',
    },

       
       { id: '22', 
        title: 'O homem de giz', 
        author: 'C. J. Tudor', 
        price: ' R$65,00', 
        description: 'Alternando habilidosamente entre presente e passado, O Homem de Giz traz o melhor do suspense: personagens maravilhosamente construídos, mistérios de prender o fôlego e reviravoltas que vão impressionar até os leitores mais escaldados.',
        OriginalPrice:'R$69,90 ',  Assessment:'★★★★★', 
        book0:'https://m.media-amazon.com/images/I/414ONi-RmLL._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/51BKxF03OvL._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/61fNSPuillL._SL1000_.jpg',
        genero: 'Suspense',
        genero2: 'Thriller',},
        
        { id: '23', 
        title: 'O nome do vento (A Crônica do Matador do Rei) ', 
        author: 'Patrick Rothfuss', 
        price: ' R$49,90', 
        description: 'Ninguém sabe ao certo quem é o herói ou o vilão desse fascinante universo criado por Patrick Rothfuss. Na realidade, essas duas figuras se concentram em Kote, um homem enigmático que se esconde sob a identidade de proprietário da hospedaria Marco do Percurso.',
        OriginalPrice:'R$79,90 ',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/81CGmkRG9GL._SY425_.jpg', book1:'https://m.media-amazon.com/images/I/91+YttBCTpL._SY425_.jpg',
       genero: 'Fantasia',
       genero2: 'Aventura',},

        { id: '24', 
        title: 'Duna', 
        author: 'Frank Herbert', 
        price: ' R$69,33', 
        description: 'Uma estonteante mistura de aventura e misticismo, ecologia e política, este romance ganhador dos prêmios Hugo e Nebula deu início a uma das mais épicas histórias de toda a ficção científica. Duna é um triunfo da imaginação, que influenciará a literatura para sempre.Esta edição inédita, com introdução de Neil Gaiman, apresenta ao leitor o universo fantástico criado por Herbert e que será adaptado ao cinema por Denis Villeneuve, diretor de A chegada e de Blade Runner 2049.',
        OriginalPrice:'R$99,90 ',  Assessment:'★★★★★', 
       book0:'https://m.media-amazon.com/images/I/41MRn6hy8-L._SY445_SX342_.jpg', book1:'https://m.media-amazon.com/images/I/81ooFNSzr7L._SL1500_.jpg', book2:'https://m.media-amazon.com/images/I/51s1qGA6UQL.jpg',
       genero: 'Ficção Científica',
       genero2: 'Fantasia',
    },

    {
        id: '25',
        title: '1984',
        author: 'George Orwell',
        price: 'R$39.90',
        description: 'Publicada originalmente em 1949, a distopia futurista 1984 é um dos romances mais influentes do século XX, um inquestionável clássico moderno. Lançada poucos meses antes da morte do autor, é uma obra magistral que ainda se impõe como uma poderosa reflexão ficcional sobre a essência nefasta de qualquer forma de poder totalitário.',
        OriginalPrice: 'R$49.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/819js3EQwbL._SL1500_.jpg', 
        book1:'https://m.media-amazon.com/images/I/812YrJzjlIL._SL1500_.jpg',
        book2:'https://m.media-amazon.com/images/I/61IZzJa5YLL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Distopia'
    },
    {
        id: '26',
        title: 'O Grande Gatsby',
        author: 'F. Scott Fitzgerald',
        price: 'R$44.90',
        description: 'Agora você pode viver o sonho americano! Bem-vindo à mansão de Gatsby! Depois de receber um convite para uma festa luxuosa e extravagante em Long Island, Nick Carraway, um jovem solteiro que acaba de se mudar para Nova York, fica curioso a respeito do anfitrião, o misterioso Jay Gatsby. Excêntrico, porém reservado, Gatsby é um self-made man cujo passado é desconhecido e com negócios obscuros. À medida que Nick e Gatsby começam uma amizade improvável, Nick descobre que nem tudo que reluz é ouro, e que tudo o que seu vizinho mais quer na vida é recuperar o amor de Daisy, prima de Nick.',
        OriginalPrice: 'R$54.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/71+G89dpO4L._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/51ql0oWDIXL._SL1440_.jpg',
        book2: 'https://m.media-amazon.com/images/I/51Apk918jJL._SL1440_.jpg',
        genero: 'Romance',
        genero2: 'Clássico',
    },
    {
        id: '27',
        title: 'A Metamorfose',
        author: 'Franz Kafka',
        price: 'R$29.90',
        description: 'O caixeiro-viajante Gregor acorda metamorfoseado em um enorme inseto e percebe que tudo mudou e não só em sua vida, mas no mundo. Ele, então, acompanha as reações de sua família ao perceberem o estranho ser em que ele se tornou. E, enquanto luta para se manter vivo, reflete sobre o comportamento de seus pais, de sua irmã e sobre a sua nova vida',
        OriginalPrice: 'R$39.90',
        Assessment: '★★★★☆',
        book0: 'https://m.media-amazon.com/images/I/715JOcuqSSL._SL1021_.jpg',
        book1: 'https://m.media-amazon.com/images/I/613fhjH8fpL._SL1000_.jpg',
        book2: 'https://m.media-amazon.com/images/I/71RhFLlaxEL._SL1500_.jpg',
        book3: 'https://m.media-amazon.com/images/I/81D6UEHDiBL._SL1500_.jpg',
        book4: 'https://m.media-amazon.com/images/I/71C3ctoaikL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Surrealismo',
    },
    {
        id: '28',
        title: 'Cem Anos de Solidão',
        author: 'Gabriel García Márquez',
        price: '49.90',
        description: 'Neste clássico de Gabriel García Marques, conheça as fabulosas aventuras dos Buendía-Iguarán, com seus milagres, fantasias e dramas que representam famílias do mundo inteiro. Romance fundamental na história da literatura,  Cem anos de solidão apresenta uma das mais fascinantes aventuras literárias do século XX. Vencedora do Prêmio Nobel de Literatura, uma obra que todos devíamos ter em nossas estantes.',
        OriginalPrice: 'R$59.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/817esPahlrL._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/81ogOb2Z1OL._SL1500_.jpg',
        book2: 'https://m.media-amazon.com/images/I/71CFWBBPxeL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Realismo Mágico',
    },
    {
        id: '29',
        title: 'O Sol é para Todos',
        author: 'Harper Lee',
        price: 'R$34.90',
        description: 'Um dos maiores clássicos da literatura mundial. O sol é para todos ganhou o Prêmio Pulitzer em 1961 e deu origem a um filme homônimo, vencedor do Oscar de melhor roteiro adaptado, em 1962. Lançado pela primeira vez em 1960, até hoje vende mais de um milhão de cópias por ano em língua inglesa. Uma história atemporal sobre tolerância, perda da inocência e conceito de justiça. ',
        OriginalPrice: 'R$44.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/91WKPd60P4L._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/81Q4M9UtJ1L._SL1500_.jpg',
        book2: 'https://m.media-amazon.com/images/I/818NT3GSvsL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Clássico',
    },
    {
        id: '30',
        title: 'A Revolução dos Bichos',
        author: 'George Orwell',
        price: 'R$29.90',
        description: 'Publicado em 1945, A revolução dos bichos alçou o posto de um dos maiores clássicos da literatura moderna e projetou seu autor, George Orwell, como um dos mais influentes da história. Esta é uma fábula atual, que satiriza o totalitarismo, a tirania e a busca pelo poder.',
        OriginalPrice: 'R$39.90',
        Assessment: '★★★★☆',
        book0: 'https://m.media-amazon.com/images/I/81DBKwEXkFL._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/81hgR7EFl5L._SL1500_.jpg',
        book2: 'https://m.media-amazon.com/images/I/81F2-vcnLKL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Política',
    },

    {
        id: '31',
        title: 'Frankenstein',
        author: 'Mary Shelley',
        price: '39.90',
        description: 'Obcecado pela ideia de dar vida à matéria inanimada, o cientista Victor Frankenstein entra em pânico e foge quando finalmente consegue ter sucesso criando um monstro feito de restos humanos. Entregue ao abandono e à rejeição, a criatura vai atrás do seu criador, em busca de respostas e vingança.',
        OriginalPrice: 'R$49.90',
        Assessment: '★★★★☆',
        book0: 'https://m.media-amazon.com/images/I/91Kz+sC5X0L._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/91bE19eBRYL._SL1500_.jpg',
        book2: 'https://m.media-amazon.com/images/I/91EFhEj0i9L._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Terror',
    },
    {
        id: '32',
        title: 'A Cor Púrpura',
        author: 'Alice Walker',
        price: 'R$42.90',
        description: 'Apesar da dramaticidade do enredo, A cor púrpura é uma história sobre mudanças, redenção e amor. A partir da vida de Celie, a aclamada escritora Alice Walker tece críticas ao poder dado aos homens em uma sociedade que ainda hoje luta por igualdade entre gêneros, raças e classes sociais. Eleito pela BBC um dos 100 romances que definem o mundo, A cor púrpura é um retrato da vivência da mulher negra na época da segregação racial, cujos reflexos ainda estão presentes na nossa sociedade.',
        OriginalPrice: 'R$52.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/719J3+g-GuL._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/71JYQPn8O2L._SL1500_.jpg',
        book2: 'https://m.media-amazon.com/images/I/91z4AIKZPrL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Drama',
    },
    {
        id: '33',
        title: 'O Senhor dos Anéis: A Sociedade do Anel',
        author: 'J.R.R. Tolkien',
        price: 'R$59.90',
        description: 'O volume inicial de O Senhor dos Anéis, lançado originalmente em julho de 1954, foi o primeiro grande épico de fantasia moderno, conquistando milhões de leitores e se tornando o padrão de referência para todas as outras obras do gênero até hoje. A imaginação prodigiosa de J.R.R. Tolkien e seu conhecimento profundo das antigas mitologias da Europa permitiram que ele criasse um universo tão complexo e convincente quanto o mundo real.',
        OriginalPrice: 'R$69.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/81hCVEC0ExL._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/815o3g+yDSL._SL1500_.jpg',
        book2: 'https://m.media-amazon.com/images/I/71bWmLcz45L._SL1500_.jpg',
        genero: 'Fantasia',
        genero2: 'Aventura',
    },
    {
        id: '34',
        title: 'O Processo',
        author: 'Franz Kafka',
        price: 'R$34.90',
        description: 'Josef K. ocupa um cargo de grande responsabilidade em um prestigiado banco e exerce sua função com dedicação. No dia em que completa 30 anos é detido e os que o cercam começam a tratá-lo diferente, principalmente no local de trabalho. Interrogado e condenado sem saber sob qual acusação e a lei que a embasa, trava uma batalha para entender o que está acontecendo, se embrenhando em um labirinto burocrático que não oferece respostas, o deixando sem alternativas para sua defesa.',
        OriginalPrice: 'R$44.90',
        Assessment: '★★★★☆',
        book0: 'https://m.media-amazon.com/images/I/61rHTFLIceL._SL1000_.jpg',
        genero: 'Ficção',
        genero2: 'Surrealismo',
       
    },
    {
        id: '35',
        title: 'A Sombra do Vento',
        author: 'Carlos Ruiz Zafón',
        price: 'R$54.90',
        description: 'Barcelona, 1945. Daniel Sempere acorda na noite de seu aniversário de onze anos e percebe que já não se lembra do rosto da falecida mãe. Para consolá-lo, o pai leva o menino pela primeira vez ao Cemitério dos Livros Esquecidos. É lá que Daniel descobre A sombra do vento, romance escrito por Julián Carax, que logo se torna seu autor favorito, sua obsessão. No entanto, quando começa a buscar outras obras do escritor, Daniel descobre que alguém anda destruindo sistematicamente todos os exemplares de todos os livros que Carax já publicou, e que o que tem nas mãos pode muito bem ser o último volume sobrevivente. Junto com seu amigo Fermín, Daniel percorre a cidade, adentrando as ruelas e os segredos mais obscuros de Barcelona. Anos se passam e sua investigação inocente se transforma em uma trama de mistério, magia, loucura e assassinato. E o destino de seu autor favorito de repente parece intimamente conectado ao dele.',
        OriginalPrice: 'R$64.90',
        Assessment: '★★★★☆',
        book0: 'https://m.media-amazon.com/images/I/91xOzA3VHtL._SL1500_.jpg',
        book1: 'https://m.media-amazon.com/images/I/71aZfSZMQoL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Mistério',
    },
    {
        id: '36',
        title: 'A História Sem Fim',
        author: 'Michael Ende',
        price: 'R$49.90',
        description: 'Um garoto descobre um livro mágico que o transporta para um mundo de fantasia.',
        OriginalPrice: 'R$59.90',
        Assessment: '★★★★★',
        book0: 'https://m.media-amazon.com/images/I/71X-YY3HIjL._SL1500_.jpg',
        genero: 'Ficção',
        genero2: 'Fantasia',
    },

    {
        id: '37',
        title: 'COM AMOR, CLARA"',
        author: 'FABIO VICCENT',
        price: 'R$49.90',
        description: 'Por mais que estivesse cercada de pessoas, Clara, sentia solidão. Essa angústia existe, pois ela perdeu seu bem mais precioso... Sem se despedir, sua mãe apenas se fora desta vida. Com isso, o mundo, que antes era iluminado e feliz, em pouco tempo, tornou-se cinza e sem sentido. Surge, então, o refúgio necessário para seguir em frente: Clara decide escrever cartas para sua mãe diariamente. A certeza de que serão lidas alimenta sua fé e esperança. Ela não sabia exatamente onde sua mãe estava, mas sabia que, independente do tempo que levasse, elas se reencontrariam para o abraço que tanto fez falta. Clara estava certa! Após momentos na escuridão, eis que surge a luz necessária para mostrá-la que tudo fica bem para os que tem amor no coração.',
        OriginalPrice: 'R$59.90',
        Assessment: '★★★★★',
        book0: 'https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2020-05-31-at-18-50-291-567faf02c9da72890815909627636200-1024-1024.webp',
        book1: 'https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2020-05-31-at-18-50-151-40ddb52ad4effd25a115909627636724-640-0.webp',
        genero: 'Crônicas',
    },

    {
        id: '38',
        title: 'SEJA LIVRE',
        author: 'FABIO VICCENT',
        price: 'R$38,00',
        description: '"O som dos sinos anuncia a chegada do natal. E com ela, as luzes que iluminam a casa e o nosso espírito. É época de festa, alegria, paz e reflexão! Todos nós temos lembranças de um natal marcante e, é justamente nessa perspectiva, que compartilhamos com vocês crônicas natalinas, daquelas que aquecem o nosso coração e nos fazem tão esperançosos por dias melhores, dias alegres e, a certo ponto, com cheirinho e gosto de infância. Contos natalinos são parte de nossa história de vida e da tradição literária de nossas culturas e é, justamente por isso, que, aqui, propomos trazer esse mundo de sonhos à realidade.',
        OriginalPrice: 'R$32,00',
        Assessment: '★★★★★',
        book0: 'https://acdn.mitiendanube.com/stores/001/018/983/products/whatsapp-image-2021-03-23-at-20-03-161-b9673b4dd75b55c3c416165414220481-1024-1024.webp',
        genero: 'Crônicas',
    },

    {
        id: '39',
        title: 'Diva do Cotidiano',
        author: 'FABIO VICCENT',
        price: 'R$28,00',
        description: 'Divã do Cotidiano” não é, de forma alguma, um manual de instruções, mas uma reflexão sobre a subjetividade da nossa existência. É um convite para dançarmos com o caos diário que nos cerca, enquanto buscamos sobreviver aos cortes que a vida nos impõe. Acima de tudo, é sobre aceitar que somos o que é possível ser, mesmo que isso não corresponda às nossas fantasias.',
        OriginalPrice: 'R$15,00',
        Assessment: '★★★★★',
        book0: 'assets/img/Livros_Fabio/Diva_do_cotidiano.jpeg',
        genero: 'Crônicas',
    },

    {
        id: '40',
        title: 'Entre a Realidade e o Perdão',
        author: 'Daniel Lamarão',
        price: 'R$48,00',
        description: '"Entre a Realidade e o Perdão" acompanha a história de Ethan, um jovem que, após ter um sonho intenso e inquietante, começa a revisitar memórias esquecidas de sua infância. Assombrado por sensações de perda e mistério, ele percebe que há algo importante escondido em seu passado que foi suprimido. Conforme os sonhos se tornam mais vívidos, Ethan sente que precisa descobrir o que realmente aconteceu anos atrás para compreender quem ele é e enfrentar os traumas que ainda o perseguem. Com o apoio de sua mãe e amigos próximos, ele embarca em uma jornada cheia de revelações inesperadas e segredos familiares, buscando respostas que poderão mudar sua vida para sempre. A realidade pode ser mais difícil de aceitar do que ele jamais imaginou, e o perdão será sua maior busca.',
        OriginalPrice: 'R$32,00',
        Assessment: '★★★★★',
        book0: 'assets/img/Livro_Editora/Frente.jpeg',
        book1: 'assets/img/Livro_Editora/Verso.jpeg',
        genero: 'Drama ',
        genero2: 'Suspense',
    },


    ];

    const book = books.find(b => b.id === bookId);
    
    if (book) {
        document.getElementById('Titulo').innerText = book.title;
        document.getElementById('Autor').innerText = book.author;
        document.getElementById('Preco').innerText = book.price;
        document.getElementById('Descricao').innerText = book.description;
        document.getElementById('OriginalPreco').innerText = book.OriginalPrice;
        document.getElementById('Avaliacao').innerText = book.Assessment;
        document.getElementById('img0').src = book.book0;
        document.getElementById('img1').src = book.book1;
        document.getElementById('img2').src = book.book2;
        document.getElementById('img3').src = book.book3;
        document.getElementById('img4').src = book.book4;

          // Definir imagens apenas se elas estiverem disponíveis
          if (book.book0) document.getElementById('img0').src = book.book0;
          if (book.book1) document.getElementById('img1').src = book.book1;
          if (book.book2) document.getElementById('img2').src = book.book2;
          if (book.book3) document.getElementById('img3').src = book.book3;
          if (book.book4) document.getElementById('img4').src = book.book4;
    } else {
        alert('Livro não encontrado');
    }
}

// Executar ao carregar a página
window.onload = loadBookDetails;

