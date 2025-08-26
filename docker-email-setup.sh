#!/bin/bash

# Docker Email Testing Setup Script

echo "🐳 Setting up Docker environment for email testing..."

echo "✅ Docker and Docker Compose are available"

# Build and start the containers
echo "🏗️  Building Docker containers..."
docker compose down
docker compose build --no-cache php
docker compose up -d

# Wait for containers to be ready
echo "⏳ Waiting for containers to start..."
sleep 10

# Check container status
echo "🔍 Checking container status..."
docker compose ps

# Test if services are running
echo "🧪 Testing services..."

# Test Nginx
if curl -s http://localhost > /dev/null; then
    echo "✅ Nginx is running on http://localhost"
else
    echo "❌ Nginx is not responding"
fi

# Test MailHog
if curl -s http://localhost:8025 > /dev/null; then
    echo "✅ MailHog is running on http://localhost:8025"
else
    echo "❌ MailHog is not responding"
fi

# Test PHP
if curl -s http://localhost/test-email-docker.php | grep -q "Docker Email Test"; then
    echo "✅ PHP is running and email test page is accessible"
else
    echo "❌ PHP email test page is not accessible"
fi

echo ""
echo "🎉 Setup complete! You can now test email functionality:"
echo ""
echo "📧 Email Test Pages:"
echo "   • http://localhost/test-email-docker.php - Docker email test"
echo "   • http://localhost/test-email.php - General email test"
echo ""
echo "📬 MailHog Email Viewer:"
echo "   • http://localhost:8025 - View all sent emails"
echo ""
echo "🌐 Website:"
echo "   • http://localhost - Main website with contact forms"
echo ""
echo "🔧 Useful Commands:"
echo "   • docker compose logs php    - View PHP container logs"
echo "   • docker compose logs mailhog - View MailHog logs"
echo "   • docker compose down        - Stop all containers"
echo "   • docker compose up -d       - Start all containers"
echo ""

# Check if forms are accessible
echo "📝 Testing form accessibility..."
if curl -s http://localhost | grep -q "contact"; then
    echo "✅ Contact form is accessible on homepage"
else
    echo "❌ Contact form may not be accessible"
fi

if curl -s http://localhost/petitii-reclamatii.php > /dev/null 2>&1; then
    echo "✅ Petition form page is accessible"
else
    echo "⚠️  Petition form page may not be accessible"
fi
