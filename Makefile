# Load environment variables from .env file if it exists
ifneq (,$(wildcard ./.env))
    include .env
    export
endif

# Variables
IMAGE_NAME = railto/omac
TAG ?= latest
DOCKER_REGISTRY = docker.io
DEPLOY_API_URL ?= none

# Help target
.PHONY: help
help:
	@echo "Available targets:"
	@echo "  build     - Build Docker image"
	@echo "  tag       - Tag Docker image"
	@echo "  push      - Push Docker image to registry"
	@echo "  deploy    - Call deployment API"
	@echo "  all       - Build, tag, push, and deploy"
	@echo ""
	@echo "Variables:"
	@echo "  TAG              - Image tag (default: latest)"
	@echo "  DEPLOY_API_URL   - Deployment API endpoint"

# Build Docker image
.PHONY: build
build:
	@echo "Building Docker image..."
	docker build -t $(IMAGE_NAME):$(TAG) .

# Tag Docker image (if built with different tag)
.PHONY: tag
tag:
	@echo "Tagging Docker image..."
	docker tag $(IMAGE_NAME):$(TAG) $(DOCKER_REGISTRY)/$(IMAGE_NAME):$(TAG)

# Push Docker image to registry
.PHONY: push
push: build
	@echo "Pushing Docker image to registry..."
	docker push $(DOCKER_REGISTRY)/$(IMAGE_NAME):$(TAG)

# Deploy via API call
.PHONY: deploy
deploy:
	@echo "Calling deployment API..."
	curl -X POST $(DEPLOY_API_URL) \
		-H "Content-Type: application/json" \
		-d '{"image": "$(DOCKER_REGISTRY)/$(IMAGE_NAME):$(TAG)"}'

# Complete pipeline: build, tag, push, and deploy
.PHONY: all
all: push deploy
	@echo "Build, push, and deployment complete!"

# Clean up local images
.PHONY: clean
clean:
	@echo "Cleaning up local images..."
	docker rmi $(IMAGE_NAME):$(TAG) $(DOCKER_REGISTRY)/$(IMAGE_NAME):$(TAG) 2>/dev/null || true
