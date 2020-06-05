
def dockerPublisherName = "ushakiran20"

def apacheLocalImage = "apache2-updated"
def mysqlLocalImage = "mysql-updated"

def gitBranch

properties([pipelineTriggers([githubPush()])])
pipeline {
    agent {
        node {
            label 'aws_node_two'
        }
    }

    stages {
        


        stage('Build') {
            steps {
                script {
                    gitBranch=getBranchName "${GIT_BRANCH}"

                    if(gitBranch == 'master' || gitBranch == 'dev'){
                
                    sh """
                            echo ${gitBranch}
                            docker rmi ${apacheLocalImage} || true
                        
                            if  docker images | grep $mysqlLocalImage
                            then
                                echo "mysql image already exists"
                            else
                                docker build -t ${mysqlLocalImage} mysql/
                                docker tag ${mysqlLocalImage} ${dockerPublisherName}/${mysqlLocalImage}
                            fi
                            docker build -t ${apacheLocalImage} apache/
                        """
                    sh "docker tag ${apacheLocalImage} ${dockerPublisherName}/${apacheLocalImage}"}


                }
            }
        }

           stage('Deploy') {
               steps {
                   script {
                       if(gitBranch == 'master' || gitBranch == 'dev'){
                            sh "docker stack deploy --compose-file docker-compose.yml dockerstack3"
                       }
                   }
               }
           }

      

    }
}

String getBranchName(String inputString) {
    return inputString.split("/")[1]
}