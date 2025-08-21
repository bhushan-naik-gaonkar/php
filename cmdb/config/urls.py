"""
URL configuration for config project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/5.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path, include
from rest_framework import routers
from core.api import (
    DepartmentViewSet,
    TeamViewSet,
    TagViewSet,
    ResourceViewSet,
    ResourceRelationshipTypeViewSet,
    ResourceRelationshipViewSet,
)
from core.views import HomeView, ResourceListView, ResourceDetailView

router = routers.DefaultRouter()
router.register(r'departments', DepartmentViewSet)
router.register(r'teams', TeamViewSet)
router.register(r'tags', TagViewSet)
router.register(r'resources', ResourceViewSet)
router.register(r'relationship-types', ResourceRelationshipTypeViewSet)
router.register(r'relationships', ResourceRelationshipViewSet)

urlpatterns = [
    path('', HomeView.as_view(), name='home'),
    path('resources/', ResourceListView.as_view(), name='resource-list'),
    path('resources/<int:pk>/', ResourceDetailView.as_view(), name='resource-detail'),
    path('admin/', admin.site.urls),
    path('api/', include(router.urls)),
]
