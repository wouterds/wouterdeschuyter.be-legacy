import static Constants.*

class Constants {
  static final PROJECT = 'internal-wouterdeschuyter-main-website'
  static final DOCKER_FOLDER = '~/docker/projects/' + PROJECT
  static final SERVER = 'server03.wouterdeschuyter.be'
}

node {
  stage('Checkout') {
    sh 'printenv'
    checkout scm
  }

  stage('Clean') {
    sh 'make clean'
  }

  stage('Dependencies') {
    sh 'make dependencies'
  }

  stage('Build') {
    sh 'make build'
  }

  stage('Deploy') {
    if (!env.BRANCH_NAME.equals('develop') && !env.BRANCH_NAME.equals('master')) {
      sh 'echo Not develop and not master branch, skip deploy.'
      return
    }

    // Push images to registry
    sh 'echo Pushing version'
    sh 'make push-latest'

    // Deploy staging
    deployStaging()
  }

  // Leave Jenkins clean behind
  cleanWorkspace()
}

def deployStaging() {
  if (!env.BRANCH_NAME.equals('develop')) {
    return
  }

  // Separate folder per environment
  def folder = DOCKER_FOLDER + '-stag'

  // Deploy staging
  sh 'echo Deploying staging..'

  // Make directory, in case it doesn't exist
  sh 'ssh wouterds@'+SERVER+' "mkdir -p '+folder+'"'

  // Copy our docker-compose files to the server
  sh 'scp docker/docker-compose.yml wouterds@'+SERVER+':'+folder+'/docker-compose.yml'
  // sh 'scp docker/docker-compose-staging.yml wouterds@'+SERVER+':'+folder+'/docker-compose-staging.yml'
  // sh 'scp .env.example wouterds@'+SERVER+':'+folder+'/.env'

  // // Deploy on staging
  // sh 'ssh wouterds@'+SERVER+' "cd '+folder+'; docker-compose -f docker-compose.yml -f docker-compose-staging.yml pull"'
  // sh 'ssh wouterds@'+SERVER+' "cd '+folder+'; docker-compose -f docker-compose.yml -f docker-compose-staging.yml up -d"'
}


def cleanWorkspace() {
  sh 'echo "Cleaning up workspace.."'
  deleteDir()
}
