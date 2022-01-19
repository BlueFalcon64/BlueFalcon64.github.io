let numeroCommentaire = 3
function addComment(nom, texte) {

    var now = new Date();

    var annee   = now.getFullYear();
    var mois    = now.getMonth() + 1;
    var jour    = now.getDate();
    var heure   = now.getHours();
    var minute  = now.getMinutes();

    const listeCommentaire = document.getElementById('comments-list')

    const commentaireArticle = document.createElement('article')
    commentaireArticle.setAttribute('id','comment-' + numeroCommentaire)
    commentaireArticle.classList.add('comment','border','rounded','p-2','mb-3')
    listeCommentaire.append(commentaireArticle)

    const commentaireHeader = document.createElement('strong')
    commentaireHeader.classList.add('mb-2','border-bottom')
    commentaireArticle.append(commentaireHeader)

    const date = document.createElement('i')
    date.classList.add('mb-2','border-bottom')
    date.append("le "+jour+"/"+mois+"/"+annee+" à "+heure+" heure "+minute+" minutes ")

    const commentaireParagraphe = document.createElement('p')
    commentaireHeader.append(nom)
    commentaireParagraphe.append(texte)
    commentaireArticle.append(commentaireParagraphe)
    
    
    
    commentaireHeader.append( "le "+jour+"/"+mois+"/"+annee+" à "+heure+" heure "+minute+" minutes ")
    numeroCommentaire++
}

function onReceived(){

    const Name = document.getElementById("nom").value

    const Content = document.getElementById("message-content").value

    if(Name === "" || Content === "") return;

    addComment(Name, Content)

    document.getElementById("new-comment").reset()
}