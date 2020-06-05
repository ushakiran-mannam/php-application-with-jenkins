
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
                    sh """
                            gitBranch=getBranchName "${GIT_BRANCH}"

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
                    sh "docker tag ${apacheLocalImage} ${dockerPublisherName}/${apacheLocalImage}"
            }
        }

           stage('Deploy') {
               steps {
                   sh "docker stack deploy --compose-file docker-compose.yml dockerstack3"
               }
           }

        

        // stage('Clean') {
        //     steps {
        //         script {
        //             if (gitBranch == 'master' || gitBranch == 'develop'){
        //                 sh "docker rmi ${customLocalImage} || true"
        //                 sh "docker system prune -f || true"
        //             } else if (gitBranch.contains('feature')) {
        //                 echo "It is a feature branch"
        //             }
        //         }
        //     }
        // }

    }
}

// void publishInECS(String customLocalImage) {
//     // echo "${customLocalImage}"
    
// }

// void deployToECS() {
//     sh '''
//         dockerRepo=`aws ecr describe-repositories --repository-name jenkins-test-repo --region us-east-1 | grep repositoryUri | cut -d "\"" -f 4`
//         sed -e "s;DOCKER_IMAGE_NAME;${dockerRepo}:latest;g" ${WORKSPACE}/template.json > taskDefinition.json
//         aws ecs register-task-definition --family jenkins-test --cli-input-json file://taskDefinition.json --region us-east-1
//         revision=`aws ecs describe-task-definition --task-definition jenkins-test --region us-east-1 | grep "revision" | tr -s " " | cut -d " " -f 3`
//         aws ecs update-service --cluster test-cluster --service test-service --task-definition jenkins-test:${revision} --desired-count 1
//     '''
// }

String getBranchName(String inputString) {
    return inputString.split("/")[1]
}